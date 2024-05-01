import serial
import serial.tools.list_ports
import time
import db
import datetime

def is_payment_valid(exp_time):
    now = datetime.datetime.now()
    exp=datetime.datetime.strptime(exp_time, '%Y-%m-%d')

    return exp>now




def compare(arduino):
    inp=int(input("Ener user id >> "))
    user=db.get_user_by_id(inp)
    if not user:
        print("[-] No user found")
        return
    
   
    if not is_payment_valid(user["date_of_expiry"]):
        print(f"[-] Hello {user['first_name']} Your Subscription has expired!")
        return
    
    if not user["template"]:
        print(f"[!] Sorry no template registed for user {user['first_name']}!")
        return
    bytt=db.get_file(user["template"])
    #bytt=db.get_file(None)
    _=arduino.read_all()#clear buffer
    arduino.write(str.encode("MA"))
    arduino.write(bytt)
    sleep_time=1
    while True:
        time.sleep(sleep_time)
        status = arduino.readline()
        print(f"msg->\t{status}")
        if status==b"okmc\r\n" :
            msg=arduino.read(768)
            if(msg==bytt):
                print("[+] Sucefually uploaded Template :)")
            else:
                print("[!] Fail To upload Template :(")

        if status==b'Waiting for valid finger\r\n':
            status = arduino.readline()
            time.sleep(0.1)
            while status==b'.\r\n' or status==b'':
                status = arduino.readline()
            print(f"msg->\t{status}")
            
        
        if status==b"bybymc\r\n":
            print("[*] Execting Comparing..")
            return
        

    return "error"


def extract(arduino): # 9 inch
    _=arduino.read_all()#clear buffer
    arduino.write(str.encode("G-D*2\n"))
    while True:
        time.sleep(1)
        status = arduino.readline()
        print(status)
        string=status.decode()

        if(string=="\t\t\tmc\r\n"):
            print("Got template header, Reading rest of file...")
            time.sleep(1)
            bytte=arduino.read(768)
            file_name=input("Enter File Name >> ")
            f = open(file_name, "wb")
            f.write(bytte)
            f.close()
            _=arduino.read_all()
            print("[+] Finising exporting fp template (.)(.)")
            return 

        print(f"msg for serial:\n\t{string}")
    return "error"




def init():
    ports=serial.tools.list_ports.comports()
    ports=sorted(ports)
    print("*********** Select arduino Board Port **************")
    i=0

    for port, desc, hwid in ports:
        print(f"[{i}] {port}: {desc} [{hwid}]")
        i+=1

    option=int(input(">> "))
    if option>=i:
        print("[!] Please selet a valid option")
        exit()
    port=ports[option][0]
    print(f"[*] Selected {port} ...")
    print(f"[-] Enter the bud rate ( Recomended: 9600 )")
    bud=int(input(">>"))
    arduino = serial.Serial(port=port,   baudrate=bud, timeout=.1)
    time.sleep(2)    
    return arduino
    
def quantize_percentage(per):
    floor_val=[0,5,25,50,75,100]
    quantized_value = min(floor_val, key=lambda x: abs(x - per))
    return quantized_value


if __name__=="__main__":
    arduino=init()
    while(True):
        print("*************** Menu ******************")
        print(f"[0] Template Extration.")
        print(f"[1] Compare Finger print.")
        print(f"[99] Exit.")

        inp=int(input("Enter option >>"))
        if(inp==0):
            res=extract(arduino)
        if (inp==1):
            res=compare(arduino)
        if (res==99):
            break
        


