document.addEventListener('DOMContentLoaded', function(){
    const searchBtn= document.getElementById('lookup');
    const searchbox= document.getElementById('country');
    const resultDiv= document.getElementById('result');

    searchBtn.addEventListener('click', function(event){
        const query = searchbox.value.trim();

        fetch(`world.php?country=${query}`)
        .then(response => response.text())
        .then(data => {
            resultDiv.innerHTML = data; 
        })
        .catch(error => {
            console.error('Error fetching data:', error);
        });
    });
});