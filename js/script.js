$(document).ready(function () {
    $("#flash-msg").delay(7000).fadeOut("slow");
});

$(document).ready(function(){
    $('[data-toggle="tooltip"]').tooltip();   
});

$(document).ready(function(){
	$('#BoutonAjout').click(function(){
		$('#form')[0].reset();
		$('.modal-title').text("Ajouter un utilisateur");
		$('#action').val("Ajouter");
		$('#operation').val("Ajouter");
		$('#imageCharge').html('');
	});
	
	var dataTable = $('#donnee').DataTable({
		"processing":true,
		"serverSide":true,
		"order":[],
		"ajax":{
			url:"rechercher.php",
			type:"POST"
		},
		"columnDefs":[
			{
				"targets":[0, 3, 4],
				"orderable":false,
			},
		],

	});

	$(document).on('submit', '#form', function(event){
		event.preventDefault();
		var nom = $('#nom').val();
		var prenom = $('#prenom').val();
		var username = $('#username').val();
		var email = $('#email').val();
		var tel = $('#tel').val();
		var extension = $('#image').val().split('.').pop().toLowerCase();
		if(extension != '')
		{
			if(jQuery.inArray(extension, ['gif','png','jpg','jpeg']) == -1)
			{
				alert("Fichier d'image non valide");
				$('#image').val('');
				return false;
			}
		}	
		if(nom != '' && prenom != '' && username != '' && email != '' && tel != '')
		{
			$.ajax({
				url:"insertion.php",
				method:'POST',
				data:new FormData(this),
				contentType:false,
				processData:false,
				success:function(data)
				{
					alert(data);
					$('#form')[0].reset();
					$('#userModal').modal('hide');
					dataTable.ajax.reload();
				}
			});
		}
		else
		{
			alert("Les champs sont obligatoires");
		}
	});
	
	$(document).on('click', '.update', function(){
		var utilisateur_id = $(this).attr("id");
		$.ajax({
			url:"rechercheSimple.php",
			method:"POST",
			data:{utilisateur_id:utilisateur_id},
			dataType:"json",
			success:function(data)
			{
				$('#userModal').modal('show');
				$('#nom').val(data.nom);
				$('#prenom').val(data.prenom);
				$('#username').val(data.username);
				$('#email').val(data.email);
				$('#tel').val(data.tel);
				$('.modal-title').text("Editer");
				$('#utilisateur_id').val(utilisateur_id);
				$('#imageCharge').html(data.image);
				$('#action').val("Editer");
				$('#operation').val("Editer");
			}
		})
	});
	
	$(document).on('click', '.delete', function(){
		var utilisateur_id = $(this).attr("id");
		if(confirm("Êtes-vous sûr de vouloir supprimer cela?"))
		{
			$.ajax({
				url:"suppression.php",
				method:"POST",
				data:{utilisateur_id:utilisateur_id},
				success:function(data)
				{
					alert(data);
					dataTable.ajax.reload();
				}
			});
		}
		else
		{
			return false;	
		}
	});
	
	
});