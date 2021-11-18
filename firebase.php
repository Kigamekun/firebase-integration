<!DOCTYPE html>

<html lang="en">

<head>

    <!-- Required meta tags -->

    <meta charset="utf-8">

    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <title>document</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js" integrity="sha256-9/aliU8dGd2tb6OSsuzixeV4y/faTqgFtohetphbbj0=" crossorigin="anonymous"></script>

</head>

<body>




        <div class="container">


<br>

<center>
<table class="table">
  <thead>
    <tr>
    <th scope="col">No</th>
      <th scope="col">NIS</th>
      <th scope="col">Nama</th>
      <th scope="col">Action</th>
    </tr>
  </thead>
  <tbody id="tbody">
  
  </tbody>
</table>

</center>
<br>
                <div class="card">
                        <div class="card-body">
                        <form id="addUser" class="form-inline" method="POST" action="">

<div class="form-group mb-2">

    <label for="nis" class="sr-only">NIS</label>

    <input id="nis" type="text" class="form-control" name="nis" placeholder="nis"

           required autofocus>

</div>

<div class="form-group mx-sm-3 mb-2">

    <label for="nama" class="sr-only">nama</label>

    <input id="nama" type="nama" class="form-control" name="nama" placeholder="nama"

           required autofocus>

</div>

<button id="submitUser" type="button" class="btn btn-primary mb-2">Submit</button>

</form>

                        </div>

                </div>

        </div>



        <br>
        <br>
        <div id="updateBody">

        </div>

    <!-- The core Firebase JS SDK is always required and must be listed first -->

    <script src="https://www.gstatic.com/firebasejs/7.14.6/firebase-app.js"></script>

    <!-- TODO: Add SDKs for Firebase products that you want to use
         https://firebase.google.com/docs/web/setup#available-libraries -->

    <script src="https://www.gstatic.com/firebasejs/7.14.6/firebase-analytics.js"></script>

    <script src="https://www.gstatic.com/firebasejs/7.14.6/firebase-database.js"></script>


    <script>


        // Initialize Firebase

        var config = {
            apiKey: "AIzaSyBo1IZsNRHyJVhYA456froXaC_bmBR5WOc",

    authDomain: "sudi-8841e.firebaseapp.com",

    databaseURL: "https://sudi-8841e-default-rtdb.firebaseio.com",

    projectId: "sudi-8841e",

    storageBucket: "sudi-8841e.appspot.com",

    messagingSenderId: "588069754985",

    appId: "1:588069754985:web:4e864b961b7c575f252af8",

    measurementId: "G-B3M8XTE2GB"


        };

        firebase.initializeApp(config);

        firebase.analytics();


        var database = firebase.database();


        var lastIndex = 0;










        firebase.database().ref('Users/').on('value', function (snapshot) {

var value = snapshot.val();

var htmls = [];

$.each(value, function (index, value) {

    if (value) {

        htmls.push('<tr><td>' + index + '</td><td>' + value.nama + '</td><td>' + value.nis + '</td><td><button class="btn btn-info"  onclick="updateUser(this)" data-id="' + index + '">Update</button><button class="btn btn-danger"  onclick="deleteUser(this)" data-id="' + index + '">Delete</button></td></tr>');
    }

    lastIndex = index;

});

$('#tbody').html(htmls);

$("#submitUser").removeClass('desabled');

});






// UPDATEEEEEE
function updateUser(params) {




    updateID = params.dataset.id;

firebase.database().ref('Users/' + updateID).on('value', function (snapshot) {

    var values = snapshot.val();

    var updateData = '<div class="form-group"><label for="first_name" class="col-md-12 col-form-label">Name</label><div class="col-md-12"><input id="updateNama" type="text" class="form-control" name="nama" value="' + values.nama + '" required autofocus></div></div><div class="form-group"><label for="last_name" class="col-md-12 col-form-label">NIS</label><div class="col-md-12"><input id="updateNis" type="text" class="form-control" name="nis" value="' + values.nis + '" required autofocus></div></div><button id="updateSubmit" onclick="updatePost(this)" data-id="'+updateID+'" type="button" class="btn btn-primary mb-2">Submit</button>';


    $('#updateBody').html(updateData);

});


}


function updatePost(params) {
    
    updateID = params.dataset.id;

var postData = {

    nama: $('#updateNama').val(),

    nis: $('#updateNis').val(),

};


var updates = {};

updates['/Users/' + updateID] = postData;


firebase.database().ref().update(updates);


$("#updateBody").html('');

}









function deleteUser(params) {
        
        var id = params.dataset.id;

        firebase.database().ref('Users/' + id).remove();

}
        // Add Data

        $('#submitUser').on('click', function () {

            var values = $("#addUser").serializeArray();        
            var nama = values[0].value;
            var nis = values[1].value;
            var userID = lastIndex + 1;


console.log(values);


firebase.database().ref('Users/' + userID).set({

    nama: nama,

    nis: nis,

});


// Reassign lastID value

lastIndex = userID;

$("#addUser input").val("");

});









    </script>


    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>


</body>

</html>







