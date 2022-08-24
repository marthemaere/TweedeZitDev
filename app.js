document.querySelector("#btnAddComment").addEventListener("click", function(){
    //post_id
    // text
    let task_id= this.dataset.task_id;
    let text = document.querySelector("#commentText").value;

    //post naar databank
    //hallo
    let data = new FormData();

    data.append('text', text);
    data.append('task_id', task_id);

    fetch("ajax/savecomment.php",{
    method: 'POST',
    body: data
    })
    .then(response => response.json())
    .then(result => {
        console.log('Success:', result);
    })
    .catch((error) => {
         console.error('Error:', error);
     });


    //antwoord ok? toon comment onderaan
});