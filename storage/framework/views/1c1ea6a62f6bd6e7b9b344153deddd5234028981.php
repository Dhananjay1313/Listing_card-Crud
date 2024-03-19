<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Listing</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</head>
<style>
    .button {
        margin-left: 9%;
    }
</style>
<body>
    <div class="button mt-5">
        <a type="button" href="/" class="btn btn-primary">Home</a>
        <a type="button" href="/adduser" class="btn btn-primary">Add User</a>
        <a type="button" href="/listing" class="btn btn-primary">Listing</a>
    </div>
    <div class="container mt-3">
        
        <div id="cardContainer" class="row">
            
        </div>
    </div>
     <!-- Include jQuery -->
     <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

     <script>
         $(document).ready(function() {
             // AJAX request to fetch users data
             $.ajax({
                 url: "<?php echo e(route('users.index')); ?>",
                 method: 'GET',
                 dataType: 'json',
                 success: function(response) {
                     const data = response.data;
                     const cardContainer = $('#cardContainer');
 
                     // Loop through the data and create card elements
                     data.forEach(item => {
                         const card = $('<div>').addClass('card mb-3').css('width', '18rem');
                         const cardImage = $('<img>').addClass('card-img-top').attr('src', item.image).attr('alt', '...');
                         const cardBody = $('<div>').addClass('card-body');
                         const cardTitle = $('<h5>').addClass('card-title').text(`${item.firstname} ${item.lastname}`);
                         const cardText = $('<p>').addClass('card-text').text(`Email: ${item.email}`);
                         const cardFooter = $('<div>').addClass('card-footer').html(item.status);
 
                         cardBody.append(cardTitle, cardText);
                         card.append(cardImage, cardBody, cardFooter);
                         cardContainer.append(card);
                     });
                 }
             });
         });
     </script>
</body>

</html><?php /**PATH C:\wamp64\www\Admin\resources\views//listing.blade.php ENDPATH**/ ?>