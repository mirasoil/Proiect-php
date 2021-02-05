<?php include 'sections/header.sec.php' ?>   
<body>
<?php 
session_start();

//Includem meniul
include 'sections/nav.sec.php';

//includem adminController pentru a putea folosi functia getAllProducts
include 'adminController.php';

//daca loggedin si accountType nu sunt setate redirectionam spre login.html
if(isset($_SESSION['loggedin']) && isset($_SESSION['accountType'])){//daca sunt setate
	if(!($_SESSION['loggedin'] == TRUE && $_SESSION['accountType'] == 'admin')){
	//ai acces doar daca esti logat si tip cont = admin
	header('Location:login.html');
	}
} else {
	header('Location:login.html');
}


 ?>
<div class="container" style="padding-bottom: 3rem;">
	
<button onclick="showDiv('lista')">See all products</button>
<button onclick="showDiv('lista-useri')">See all users</button>

<!---div-ul pentru crearea unui produs nou---->
<div id="lista" >
	<button onclick="showDiv('new-product')" class="create-product">
		Create a new product
	</button>
	<div id="new-product">
	<form action="addProduct.php" method="post">
		<label for="product-name">
		</label>
		<input type="text" name="product-name" placeholder="Product Name" id="product-name" required><br>
		<label for="product-code">
		</label>
		<input type="product-code" name="product-code" placeholder="Code" id="product-code" required><br>
		<label for="product-image">
		</label>
		<input type="product-image" name="product-image" placeholder="Image URL" id="product-code" required><br>
		<label for="product-price">
		</label>
		<input type="product-price" name="product-price" placeholder="Price" id="product-code" required><br>
		<label for="product-stock">
		</label>
		<input type="product-stock" name="product-stock" placeholder="Stock" id="product-stock" required><br>
		<div id="desc-div"></div>
		<label for="product-desc">
		</label>
		<input type="product-desc" name="product-desc" placeholder="Description" id="product-desc" required><br>
		<div id="desc-div"></div>
		<button type="submit">Add Product </button>
		</form>
</div>
<div id="rezervat"></div>
	 	<?php 
 		$admin = new Admin();
 		$query = "SELECT * FROM tbl_product";
 		$productResult = $admin->getAllProductsNew($query);

 		if(!empty($productResult)){
 			//var_dump($product_array);

 			foreach($productResult as $key => $value){
?>
<!--Daca utilizatorul doreste sa stie mai multe despre produs, va face click pe nume sau poza acestuia si va fi redirectionat pe pagina product.php?code=... -->
		 <div class="product-item" id="products-show">
			<form method="POST" id="<?php echo 'myForm'.$productResult[$key]['id']; ?>">
				<!---Camp editabil alocat dinamic pentru fiecare proprietate--->
				<!--am adaugat un input in care sa afisez id-ul ca sa il pot trimite in deleteProduct--->
				<input type="hidden" name="product-id" id="product-id" value="<?php echo $productResult[$key]["id"]; ?>">

				<label for="product-name">Product Name</label>
				<input type="text" name="product-name"value="<?php echo $productResult[$key]["name"]; ?>" id="product-name"/><br>
				
				<label for="product-code">Product Code</label>
				<input type="text" name="product-code"value="<?php echo $productResult[$key]["code"]; ?>" id="product-code"/>
				
				<div class="product-image">
					<img src="<?php echo $productResult[$key]["image"]; ?>" class="product-image" id="product-image">
				</div>

				<label for="pi">Product Image</label>
				<input type="file" name="product-image"/>
				<br>
				
				<label for="product-price">Product Price</label>
				<input type="text" name="product-price"value="<?php echo $productResult[$key]["price"]; ?>" id="product-price"/>
				<br>
				
				<label for="product-stock">Product Stock</label>
				<input type="text" name="product-stock"value="<?php echo $productResult[$key]["stock"]; ?>" id="product-stock"/>
				<br>
				
				<label for="product-desc">Product Description</label>
				<textarea rows="4" cols="50" name="product-desc" id="product-desc"><?php echo $productResult[$key]["description"]; ?></textarea>
				<br>
				<div class="product-action">
				<input type="submit"  value="Edit" class="btnEdit" name="edit-product" id="<?php echo $productResult[$key]['id']; ?>" onclick="updateAjax(this.id)"/>
				<!-- <input type="submit"  value="Delete" class="btnDelete" id="btnDelete" name="delete-product"/>
 -->			</div>
 			<?php echo '<input type="button" id="'.$productResult[$key]['id'].'" value="delete" name="del" onclick="deleteAjax(this.id)">'; ?>
			</form>
			<button onclick="deleteAjax(<?php echo $productResult[$key]['id']; ?>" class="delete-btn">DELETE <?php echo $productResult[$key]['id']; ?></button>
		</div> 
<?php
 			}
 		}

?>
</div>


<!---Div-ul pentru afisarea userilor --->
<div id="lista-useri" style="display: none;">
	<div id="users">
		<h3><strong>... new user</strong></h3>
	<form action="execute.php" method="post">
		<label for="username">Username</label><br>
		<input type="text" name="username" placeholder="New Username" id="username" required><br>

		<label for="password">Default Password</label><br>
		<input type="text" name="password" placeholder="Default password" id="password" required><br>
		<!---Parola trebuie schimbata la prima autentificare! --->

		<label for="email">Email</label><br>
		<input type="text" name="email" placeholder="New Email" id="email" required><br>
		
		<button type="submit" name="add-user">Add User </button><br>
		</form>
</div>
	<?php 
	$admin = new Admin();
	//afisarea propriu-zisa a tuturor utilizatorilor din baza de date
	$admin->getAllUsers(); 
	?>
	<div id="rezervatAfisare"></div>
</div>
</div>
<div id="RezervatAfisare"></div>
<div class="footer" style=" bottom: 0; width: 100%; padding: 0; margin: 0;">
<?php include 'sections/footer.sec.php'; ?>
</div>
<script>
//functie apelata intern pentru a face vizibil un div rezervat
	function showDiv(id){
		
		if (document.getElementById(id).style.display === 'none') {
			document.getElementById(id).style.display = 'block';
		} else {
			document.getElementById(id).style.display = 'none';
		}
	}

//Butonul Delete
 	/*function deleteAjax(id){
     	if(confirm('Are you sure ?')){
     		$.ajax({
     			type: "POST",
     			url : 'delete.php',
     			data:{delete_id:id},
     			success: function(data){
     				console.log('success');
     			}
     		});
     	}
     }*/


//Butonul de update - NOT WORKING
	/*function updateAjax(id){
		if(confirm("Are you sure you want to update this product ?")){
			//var myform = document.getElementById("form1");
    		//var fd = new FormData(myform);
    		//var data = $('form1').serialize();
			$.ajax({
				type: "POST",
				url: 'update.php',
				data: $('#'+id+' input').serialize(),
				success: function(data){
					$('#'+id)[0].reset();
				}
			});
		}
	}*/

//NOT WORKING
/* $(document).ready(function () {
    $('.btn-primary').click(function (e) {
      e.preventDefault();
      var id =30;
      var editData = $('#form'+id+' input').serialize();
      $.ajax
        ({
          type: "POST",
          url: "update.php",
          data: {editData: $('#form'+id).serialize()},
          success: function (data) {
            //$('.result').html(data);
            console.log(editData);
            $('#form'+id)[0].reset();
            
          }
        });
    });
  });*/


/*var editData = function(id){
   //$('#'+id).load('update-form.php')

    $.ajax({    
        type: "GET",
        url: "update-form.php", 
        data:{editId:id},            
        dataType: "html",                  
        success: function(data){   

          var productData=JSON.parse(data);  
          $("input[name='name']").val(productData.name);               
          $("input[name='code']").val(productData.code);
          $("input[name='image']").val(productData.image);
          $("input[name='price']").val(productData.price);
          $("input[name='stock']").val(productData.stock);
          $("input[name='description']").val(productData.description);
           
        }

    });
};



$(document).on('submit','#form1',function(e){
        e.preventDefault();
        var id= $("input[name='id']").val(); 
         var name= $("input[name='name']").val();               
         var code= $("input[name='code']").val();
         var image= $("input[name='image']").val();
         var price= $("input[name='price']").val();
         var stock= $("input[name='stock']").val();
         var description= $("input[name='description']").val();
        $.ajax({
        method:"POST",
        url: "update-form.php",
        data:{
          updateId:id,
          name:name,
          code:code,
          image:image,
          price:price,
          stock:stock,
          description:description

        },
        success: function(data){
        $('.product-item').load('show-form.php');
        $('#msg').html(data);
   
    }});
});
*/


// function updateAjax1(id){
//             $('#form1').validate({

//                 submitHandler: function(form) {
//                     $.ajax({
//                         url: 'update.php',
//                         type: 'POST',
//                         data: $(form).serialize(),
//                         success: function(response) {
//                             console.log('success');
//                         }            
//                     });
//                 }
//             });
// }

//UPDATE
/*function trimite(){
	dateDeTrimis = preparaDate()
	cerere = new XMLHttpRequest()
	cerere.open("POST", 'update.php')
	cerere.setRequestHeader("Content-Type", "application/json")
	cerere.onreadystatechange = procesareRaspuns
	cerere.send(dateDeTrimis)
}
function preparaDate(){
	elementFormular = document.getElementById("myForm")
	obiectFormular = new FormData(elementFormular)
	obiectDate = {}
	obiectFormular.forEach(function(valoare,cheie) {obiectDate[cheie]=valoare})
	return JSON.stringify(obiectDate)

	console.log(obiectDate[cheie]=valoare)
}
function procesareRaspuns(){
	if((cerere.readyState==4)&&(cerere.status==200)){
		raspuns = cerere.responseText
		document.getElementById("rezervat").innerHTML=raspuns
	}
}*/
function updateAjax(id){
	zona = document.querySelector("#RezervatAfisare")
	elementFormular = document.querySelector("#myForm"+id)
	obiectFormular = new FormData(elementFormular)
	configurari = {method:"post",body:obiectFormular}
	fetch("update.php",configurari)
		
		.then((data) => {console.log('Success:', data);
	})
}
		
</script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
</body>
</html>


