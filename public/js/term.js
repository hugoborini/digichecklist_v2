function restartForm() {
	document.querySelector("nav").innerHTML = `<div class="title_add">
	<p>Ajoute une digiactivité</p>
	</div>
	<div class="tile_add first">nom de la digiactivites</div>
	<div class="termLike">
		<span>>$</span>
		<div id="cmd">
			<span></span>
			<div id="cursor"></div>
		</div>
		<form id="myForm">
			<input type="text" name="command" value="" />
		</form>
		</div>

		<div class="tile_add tmpmsg">

		</div>

		<div class="tile_add tmpcategory">

		</div>

		<div class="tmpbutton">

		</div>

		<div class="tmpValide">
		</div>

		<div class="tmpRepeat none">
			<img src="image/repeat.svg" alt="" srcset="">
		</div>
	`
	$(function() {
		var cursor;
		$('#cmd').click(function() {
		  $('input').focus();
		  cursor = window.setInterval(function() {
			if ($('#cursor').css('visibility') === 'visible') {
			  $('#cursor').css({
				visibility: 'hidden'
			  });
			} else {
			  $('#cursor').css({
				visibility: 'visible'
			  });
			}
		  }, 500);

		});

		$('input').keyup(function() {
		  $('#cmd span').text($(this).val());
		});

		$('input').blur(function() {
		  clearInterval(cursor);
		  $('#cursor').css({
			visibility: 'visible'
		  });
		});
	  });

}

function restartButton() {
	document.querySelector(".tmpRepeat").addEventListener("click", ()=>{
		restartForm()
		reparamAll()
	})
}



$(function() {
    var cursor;
    $('#cmd').click(function() {
      $('input').focus();
      cursor = window.setInterval(function() {
        if ($('#cursor').css('visibility') === 'visible') {
          $('#cursor').css({
            visibility: 'hidden'
          });
        } else {
          $('#cursor').css({
            visibility: 'visible'
          });
        }
      }, 500);

    });

    $('input').keyup(function() {
      $('#cmd span').text($(this).val());
    });

    $('input').blur(function() {
      clearInterval(cursor);
      $('#cursor').css({
        visibility: 'visible'
      });
    });
  });


function paramAll() {

	let info = {};
	let form = document.querySelector("#myForm");
	function handleForm(event) { event.preventDefault(); } 
	form.addEventListener('submit', handleForm);

	form.addEventListener("submit",()=>{
		template = ""

		document.querySelector(".tmpmsg").innerHTML = "categorie ?"
		categoryArray.forEach(categoryObj => {
			for (const [key, value] of Object.entries(categoryObj)) {
				template += `<div class="categoryAdd" id=${key}>${value}</div>`
			}
		});
		document.querySelector(".tmpcategory").innerHTML = template

		let click = 0;
		let categoryHistory = [];
		document.querySelectorAll(".categoryAdd").forEach(categoryAdd =>{
			categoryAdd.addEventListener("click", ()=>{

				click++;

				categoryAdd.classList.add("click")
				categoryHistory.push(categoryAdd)
				if(click > 1){

					categoryHistory[categoryHistory.length - 2].classList.remove("click")
					categoryAdd.classList.add("click")
				}
				info = {"categoryId": categoryAdd.id, "nameActivite": form.querySelector("input").value}
				console.log(info);
				document.querySelector(".tmpbutton").innerHTML = '<div class="button">validé</button>'


				document.querySelector(".tmpbutton .button").addEventListener("click", ()=>{
					$.ajax({
						url: `/ajax/addDigi`,
						type: "post",
						data: JSON.stringify(info),
						success:function(data){
							console.log(data);
							document.querySelector(".tmpValide").innerHTML = `<p class="line-1 anim-typewriter">la digi activité a bien été renter !</p>`
							setTimeout(() => {
								document.querySelector(".tmpRepeat").classList.remove("none")
							}, 2000);
						}
					})
				})
			})
		})
	})

	restartButton()
}

paramAll()

document.querySelector(".tmpRepeat").addEventListener("click", ()=>{
	restartForm()
	paramAll()
})


