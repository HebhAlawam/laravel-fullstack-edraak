<head>
<meta name="csrf-token" content="{{ csrf_token() }}">
</head>
<body>
<h2>HTML Forms</h2>

<div>
  <label for="form_name">First name:</label><br>
  <input type="text" id="product_id" name="name"><br>
  <label for="form_surname">Last name:</label><br>
  <input type="text" id="qty_input" name="surname"><br><br>
  <button onclick='proccess();'>confirm</button>
</div>
<script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
<script>
function proccess(){
   var laravelToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
   axios.post('/proccess', {
    id: document.getElementById('product_id').value,
    qty: document.getElementById('qty_input').value,
  })
  .then(function (response) {
    console.log(response.data);
  })
  .catch(function (error) {
    console.log(error);
  });
   ;
};
</script>
</body> 