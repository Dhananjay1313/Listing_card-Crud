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
    .row {
  --bs-gutter-x: rem;
  --bs-gutter-y: 0;
  display: flex;
  flex-wrap: wrap;
  margin-top: calc(-1 * var(--bs-gutter-y));
  margin-right: calc(-.5 * var(--bs-gutter-x));
  margin-left: calc(-.5 * var(--bs-gutter-x));
}
</style>
<body>
    <div class="button mt-5">
        <div class="btn-group" role="group" aria-label="Basic example">
            <a type="button" href="/" class="btn btn-primary">Home</a>
            <a type="button" href="/adduser" class="btn btn-primary">Add User</a>
            <a type="button" href="/listing" class="btn btn-primary">Listing</a>
          </div>
    </div>
    <div class="container mt-3">
        <div id="cardContainer" class="row">
            
        </div>
    </div>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script> 
    <script>
$(document).ready(function() {
    $.ajax({
        url: "/display-data",
        method: 'GET',
        dataType: 'json',
        success: function(response) {
            const data = response.data;
            const cardContainer = $('#cardContainer');

            data.forEach(item => {
                const card = $('<div>').addClass('card mb-3').css('width', '18rem');
                // const cardImage = $('<img>').addClass('card-img-top').attr('src', item.image).attr('alt', 'Image');
                const cardBody = $('<div>').addClass('card-body');
                // const cardTitle = $('<h5>').addClass('card-title').text(`User Data`);
                const cardText = $('<p>').addClass('card-text');
                
                
                cardText.append(item.image);
                cardText.append(document.createElement('br'));
                cardText.append("Firstname: ");
                cardText.append(item.firstname);
                cardText.append(document.createElement('br'));
                cardText.append("Lastname: ");
                cardText.append(item.lastname);
                cardText.append(document.createElement('br'));
                cardText.append("Email: ");
                cardText.append(item.email);
                cardText.append(document.createElement('br'));
                cardText.append("Password: ");
                cardText.append(item.password);
                cardText.append(document.createElement('br'));
                cardText.append("Gender: ");
                cardText.append(item.gender);
                cardText.append(document.createElement('br'));
                cardText.append("Role: ");
                cardText.append(item.role);
                cardText.append(document.createElement('br'));
                cardText.append("Role type: ");
                cardText.append(item.role_type);

                const cardFooter = $('<div>')
                .addClass('card-footer')
                .css({
                    'background-color': item.status == 0 ? 'green' : 'red',
                    'padding-left': '112px'
                })
                .html(item.status == 0 ? 'Active' : 'Inactive');

                // const cardFooter = $('<div>').addClass('card-footer').html(item.status);
                
                // if (item.status == 0) {
                //     cardFooter.css('background-color', 'green');
                // } else if (item.status == 1) {
                //     cardFooter.css('background-color', 'red');
                // }
                cardBody.append(cardText);
                card.append(cardBody, cardFooter);
                cardContainer.append(card);
            });
        }
    });
});
    </script>
</body>

</html><?php /**PATH C:\wamp64\www\Admin\resources\views/listing.blade.php ENDPATH**/ ?>