<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.0/jquery.min.js"></script>
<script>
    $(document).ready(function() {
        var max_fields      = 999;
        var wrapper         = $(".container1");
        var add_button      = $(".add_form_field");

        var x = 1;
        $(add_button).click(function(e){
            e.preventDefault();
            if(x < max_fields){
                x++;
                $("#formularioNyah").append('<div><input type="text" name="person[]"> <input type="text" name="tickets[]"><a href="#" class="delete">Borrar</a></div>'); //add input box
            }
            else
            {
                alert('You Reached the limits')
            }
        });

        $(wrapper).on("click",".delete", function(e){
            e.preventDefault(); $(this).parent('div').remove(); x--;
        })
    });

</script>

<div class="container1">
    <form id="form1" method="POST" action="nyah.php">
    <div id="formularioNyah"><button class="add_form_field">Add new Buyer&nbsp; <span style="font-size:16px; font-weight:bold;">+ </span></button>
    Person / Tickets<br/><br/>
    <div><input type="text" name="person[]"> <input type="text" name="tickets[]"></div>
    </div><br/>
    <input type="submit" value="Enviar">
    </form>


    Format: a;5,b;5,c;10
    <form id="form2" method="POST" action="nyah.php">
        <div><textarea name="csv"></textarea></div>
        <input type="submit" value="Enviar CSV">
    </form>
</div>