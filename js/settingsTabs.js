
/* non dovesse funzionare racchiudo tutto in una funziona anonnima? prova comunque e studia le funzioni anonime! */
    function openCity(cityName) {
        var i;
        var x = document.getElementsByClassName("city");
        for (i = 0; i < x.length; i++) {
            x[i].style.display = "none";
        }
        document.getElementById(cityName).style.display = "block";
    }