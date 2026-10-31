document.addEventListener('DOMContentLoaded', function(){
    const lookupBtn= document.getElementById('lookup');
    const lookupCitizensBtn= document.getElementById('lookup-cities');
    const searchbox= document.getElementById('country');
    const resultDiv= document.getElementById('result');

    lookupBtn.addEventListener('click', function(event){
        let query = searchbox.value.trim();

        fetch(`world.php?country=${query}&lookup=countries`)
        .then(response => response.text())
        .then(data => {
            resultDiv.innerHTML = data; 
        })
        .catch(error => {
            console.error('Error fetching data:', error);
        });
    });
    
    lookupCitizensBtn.addEventListener('click', (e) => {
        
        let query = searchbox.value.trim();
        
        fetch(`world.php?country=${query}&lookupcities=cities`)
            .then(response => response.text())
            .then(data => {
                resultDiv.innerHTML = data;
            })
            .catch(error => console.error('Error:', error));
    });
});
