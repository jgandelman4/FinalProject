why is this not in github??
<html>
  <head>
    <script>
      function appendResults(text) {
        var results = document.getElementById('results');
        results.appendChild(document.createElement('P'));
        results.appendChild(document.createTextNode(text));
      }

      function makeRequest() {
        var request = gapi.client.urlshortener.url.get({
          'shortUrl': 'http://goo.gl/fbsS'
        });
        request.execute(function(response) {
          appendResults(response.longUrl);
        });
      }

      function load() {
        gapi.client.setApiKey('AIzaSyAtbPQBk1DDAWgBAs07k3f7QKhtPa434-o');
        gapi.client.load('urlshortener', 'v1', makeRequest);
      }
    </script>
    <script src="https://apis.google.com/js/client.js?onload=load"></script>
  </head>
  <body>
    <div id="results">
    </div>
  </body>
</html>
