    function decountFor404NotFound(url) {
        var balise = $('#timeFor404');
        var time = 6;
        setInterval(function () {
            time = time - 1;
            balise.empty();
            balise.append(time);
            if(time === 0){
                window.location.replace(url);
            }
        }, 1000);
    }
