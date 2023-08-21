<!DOCTYPE html>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="{{ asset('js/global.js') }}"></script>
<script type="text/javascript">
function getProfileDashboard()
{
    var cookieName = 'token';
    var cookieValue = getCookieValue(cookieName);
    $.ajax({
        type: "get",
        url: "/getData",
        crossDomain: true,
        data: { token: getCookieValue("token") },
        success: function (data) {
            if(data.code==200)
            {
                document.getElementById('name').textContent=data.data.name;
                document.getElementById('email').textContent=data.data.email;
            }
            else
            {
                window.location.href = '/';
            }
        
        },
    });
}
function googleLogOut()
{
    $.ajax({
        type: "post",
        url: "api/auth/googleLogOut",
        headers: {
            "Content-Type": "application/x-www-form-urlencoded",
       },
        data: { token: getCookieValue("token") },
        success: function (data) {
            if(data.code="200")
            {
                window.location.href = '/';
            }
        },
    });
}
function showAddDataPrompt() {
    var result = prompt("New To Do List:", ""); // Display the prompt dialog

    if (result === null || result==="") {
      
    } else {

        $.ajax({
        type: "post",
        url: "api/addData",
        headers: {
            "Content-Type": "application/x-www-form-urlencoded",
       },
        data: { token: getCookieValue("token") ,name:result},
        success: function (data) {
            if(data.code=="200")
            {   
                location.reload();

            }
        },
    });

    }
}
function updateData(id)
{
    
    $.ajax({
        type: "post",
        url: "api/updateData",
        headers: {
            "Content-Type": "application/x-www-form-urlencoded",
       },
        data: { id:id},
        success: function (data) {
            //console.log(data);
            if(data.code=="200")
            {   
                location.reload();

            }
        },
    });
}
function getData()
{
    $.ajax({
        type: "get",
        url: "api/getData",
        headers: {
            "Content-Type": "application/x-www-form-urlencoded",
       },
        data: { token: getCookieValue("token") },
        success: function (data) {
         data.forEach(item => {
            var row = document.createElement('tr');
            var status = (item.status ==1) ? "Done": "In Progress";
            row.innerHTML = `
                <th>${item.name}</th>
                <th>${status}</th>
                <th>
                <button style="display: ${item.status ==0 ? 'block' : 'none'}" onclick="updateData(${item.id})">Complete</button>
                <button onclick="deleteData(${item.id})">Delete</button>
                </th>
            `;
            var tbody = document.querySelector('#data-table tbody');
            tbody.appendChild(row);
        });
        },
    });
}
function deleteData(id)
{
    $.ajax({
        type: "post",
        url: "api/deleteData",
        headers: {
            "Content-Type": "application/x-www-form-urlencoded",
       },
        data: { id:id},
        success: function (data) {
          
            if(data.code=="200")
            {   
                location.reload();
            }
        },
    });
}
var token = "{{ session('user_token') }}";
setCookie('token',token,1);
getProfileDashboard();
getData();
    </script>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>User Info</title>
</head>
<body>
    <div class="container">
        <main>
            <div class="user-info">
                <div class="details">
                    <h2>User Information</h2>
                    <p><strong>Name:</strong> <a id="name"></a></p>
                    <p><strong>Email:</strong> <a id="email"></a></p>
                </div>
                
            </div>
        </main>
        <table border="1" id="data-table">
            <thead>
            <tr>
                <th>Item</th>
                <th>Status</th>
                <th>Action</th>
            </tr>
            </thead>
            <tbody>
                <tr>
                   
                </tr>
               
            </tbody>
        </table>
        <button onclick="showAddDataPrompt()">New To-Do List</button>
                    <button onclick="googleLogOut()">Log Out</button>
    </div>
</body>
</html>
<style>
    table {
  font-family: arial, sans-serif;
  border-collapse: collapse;
  width: 100%;
}

td, th {
  border: 1px solid #dddddd;
  text-align: left;
  padding: 8px;
}

tr:nth-child(even) {
  background-color: #dddddd;
}
/* Reset some default styling */
body, h1, h2, p {
    margin: 0;
    padding: 0;
}

/* Basic styling */
.container {
    max-width: 800px;
    margin: 0 auto;
    padding: 20px;
    font-family: Arial, sans-serif;
}

header h1 {
    font-size: 24px;
    margin-bottom: 20px;
}

.user-info {
    display: flex;
    align-items: center;
    margin-top: 20px;
}

.user-info img {
    width: 100px;
    height: 100px;
    border-radius: 50%;
    margin-right: 20px;
}

.user-info .details {
    flex-grow: 1;
}

.user-info h2 {
    font-size: 20px;
    margin-bottom: 10px;
}

footer {
    margin-top: 20px;
    text-align: center;
    font-size: 12px;
    color: #888;
}
</style>
