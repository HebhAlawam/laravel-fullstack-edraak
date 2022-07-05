<!doctype html>
<html lang="en">
<head>
<meta charset="utf-8">
<title>Utilizando ajax con Axios</title>
<meta name="description" content="Utilizando ajax con Axios">
<meta name="author" content="Blastcoding">
<link rel="stylesheet">
</head>
<body>
<input type="button" name="" id="btnajax" class="btn btn-primary" role="button" onclick="change_message()" value="click me">
@include("tochange")
<script src="https://unpkg.com/axios/dist/axios.min.js"></script>

<script>
function change_message(){
    axios.get('/cliente/message')
    .then(function (response) {
        var contentdiv = document.getElementById("mycontent");
        contentdiv.innerHTML=response.data;
        
    })
    .catch(function (error) {
        // handle error
        console.log(error);
    });
}
</script>
</body>
</html>