<style>
    h3{
        margin-left:7px;
    }
</style>
<aside class="bg-gray-900 h-screen text-white">
    <!-- top -->
    <div class="top flex mb-8 justify-between mt-2">
        <div class="logo">
            <h1 class=" cursor-pointer">BIO DWAR</h1>
        </div>
        <div class="cross cursor-pointer">
            <span class="material-symbols-outlined">close</span>
        </div>
    </div>
    <!-- topend -->
    <div class="sidebar">
        <a href="#" class="flex mb-4 bg-gray-500" onclick="changeContent('dashboard');countt();">
            <span class="material-symbols-outlined">grid_view</span>
            <h3 class="hover:ml-4 ease-in-out duration-300">Dashboard</h3>
        </a>
        <div class="cursor-pointer mb-4">
            <div class="flex bg-gray-500">
                <span class="material-symbols-outlined cursor-pointer">groups</span>
                <h3 class="cursor-pointer hover:ml-4 ease-in-out duration-300">Customers</h3>
            </div>
           
            <div class="submenue flex flex-col">
            <a href="#" class="ml-1 mb-1 flex align" onclick="changeContent('Addcostumer')"><span class="material-symbols-outlined">chevron_right</span>Add New Costumer</a>
            <a href="#" class="ml-1 mb-1 flex align" onclick="changeContent('Viewcostumer');loadData();"><span class="material-symbols-outlined">chevron_right</span>View Costumer Details</a>
            <a href="#" class="ml-1 mb-1 flex align" onclick="changeContent('AddandEditMembership');loadDatam();"><span class="material-symbols-outlined">chevron_right</span>Add&Edit Membership</a>
            </div>
        </div>

        <div class="cursor-pointer mb-4">
            <div class="flex bg-gray-500">
                <span class="material-symbols-outlined">fitness_center</span>
                <h3 class="cursor-pointer hover:ml-4 ease-in-out duration-300">Trainer</h3>
            </div>
           
            <div class="submenue flex flex-col">
                <a href="#" class="ml-1 mb-1 flex align" onclick="changeContent('Addtrainer')"><span class="material-symbols-outlined">chevron_right</span>Add New Trainer</a>
                <a href="#" class="ml-1 mb-1 flex align" onclick="changeContent('Viewtrainerinfo');loadDataa();"><span class="material-symbols-outlined">chevron_right</span>View Trainer Details</a>
            </div>
        </div>

        
        <a href="#" class="flex mb-4 bg-gray-500" onclick="changeContent('contact')">
            <span class="material-symbols-outlined">support_agent</span>
            <h3 class="hover:ml-4 ease-in-out duration-300">Contact</h3>
        </a>
        <a href="logout" class="flex mb-4 bg-gray-500">
            <span class="material-symbols-outlined">logout</span>
            <h3 class="hover:ml-4 ease-in-out duration-300">Signout</h3>
        </a>
    </div>
</aside>
<script type="text/javascript" src="../js/jquery.js"></script>
<script>
    function changeContent(option) {
        var xhr = new XMLHttpRequest();
        var url = '../ajax_sidebar_work/ajax.php'; // Adjust the PHP script URL accordingly
        var params = 'option=' + option;
        
        xhr.open('POST', url, true);
        xhr.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');

        xhr.onreadystatechange = function() {
            if (xhr.readyState == 4 && xhr.status == 200) {
                // Update the main content area with the response from PHP
                document.getElementById('mainContent').innerHTML = xhr.responseText;
            } else if (xhr.readyState == 4) {
                // Handle error cases
                console.error('Error loading content. Status:', xhr.status);
            }
        };

        // Send the request with the provided parameters
        xhr.send(params);
    }
</script>
<!-- <style>
            aside{
                font-size: 10px;
                width:10rem;
            }
            @media (min-width:768px) {
                aside {
                    font-size: 18px;
                    width:13rem;
                }
            }
            @media (min-width:1024px) {
                aside {
                    font-size: 19px;
                    width:13rem;

                }
            }
    </style> -->
