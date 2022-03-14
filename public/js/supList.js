let sups = document.querySelectorAll(".activite_cross img")
console.log(sups);

sups.forEach(sup => {
    sup.addEventListener("click", ()=>{
        $.ajax({
            url: `/ajax/sup`,
            type: "post",
            data: JSON.stringify({id: sup.id}),
            success:function(data){
                $( "#activite_" + sup.id ).fadeOut( "fast" );
                console.log(data);
            }
        })
    })
});