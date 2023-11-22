<footer class="p-1 pt-3 text-white text-center mt-auto w-100" style="background-color: #412702;">
    <p>@copyright kelompok 5 com c</p>
</footer>

<script src="https://kit.fontawesome.com/8c8655eff1.js" crossorigin="anonymous"></script>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
<script src="pexel-api.js"></script>

<script>
    function goBack() {
        window.history.back();
    }

    function recordSearch() {
        var recognition = new window.webkitSpeechRecognition();
        recognition.lang = "en-GB";

        recognition.onresult = function (event) {
            var result = event.results[0][0].transcript;
            document.getElementById('speechToText').value = result;
        }

        recognition.start();
    }
</script>

</body>

</html>