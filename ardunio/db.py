import mysql.connector


UPLOAD_DIR="./../Client/"
mydb = mysql.connector.connect(
  host="localhost",
  user="root",
  password="",
  database="biodwar"
)


mycursor = mydb.cursor(dictionary=True)

def get_user_by_id(id):
    mycursor.execute(f"SELECT * FROM memberships WHERE id={id}")
    return mycursor.fetchone()

def get_file(file_name):
    f=open(UPLOAD_DIR+file_name,'rb')
    #f = open("1", "rb")
    bytt=f.read()
    f.close()
    return bytt