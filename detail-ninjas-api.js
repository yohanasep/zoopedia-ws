const btnDetail = document.getElementById("animalDetail");
const apiKey = "DkwbG5GnPRigexUa1Qp9Bw==BRXf4S17fNhK691Z";

const options = {
    method: "GET",
    headers: {
        "X-Api-Key": apiKey,
    },
};

const apiURL = "https://api.api-ninjas.com/v1/animals?name=";







var urlDetail = window.location.href;
var searchDetail = getParameterByName(urlDetail.trim().substr(28).replace("/", ""));
if (searchDetail) {
    $("#speechToText").val(searchDetail);
    seeAnimalsDetail(searchDetail);
}

// API NINJAS
$('#form').on('keyup', function(y) {
    if (y.keyCode === 13) {
        seeAnimalsDetail(search);
    }
});

function seeAnimalsDetail(search) {
    $.ajax({
        method: 'GET',
        url: 'https://api.api-ninjas.com/v1/animals?name=' + search,
        headers: { 'X-Api-Key': 'DkwbG5GnPRigexUa1Qp9Bw==BRXf4S17fNhK691Z' },
        contentType: 'application/json',
        success: function(data) {
            console.log(data);

            for (let i = 0; i < 5; i++) {
                console.log([i].data.name)

                const detailsOfAnimal = `
                <div>${[i].data.name}</div>
                `;
                $("#ninjas-detail").append(detailsOfAnimal);
            }

        },
        error: function(error) {
            console.log(error);
        }
    });
}