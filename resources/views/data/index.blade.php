<!DOCTYPE html>
<html>

<head>
    <title>Reverb Test</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body>
    <div class="container mt-5">
        <h3>Insert Data</h3>

        <div class="input-group mb-3">
            <input type="text" id="nameInput" class="form-control" placeholder="Enter name">
            <button class="btn btn-primary" id="insertBtn">Insert</button>
        </div>

        <ul id="dataList" class="list-group"></ul>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            document.getElementById('insertBtn').addEventListener('click', function() {
                const name = document.getElementById('nameInput').value;

                fetch('/data', {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/json',
                            'X-CSRF-TOKEN': '{{ csrf_token() }}'
                        },
                        body: JSON.stringify({
                            name: name
                        })
                    }).then(res => res.json())
                    .then(data => console.log(data));
            });

            window.Echo.channel('data-channel')
                .listen('.data.inserted', (e) => {
                    const li = document.createElement('li');
                    li.className = 'list-group-item';
                    li.textContent = e.data.name;
                    document.getElementById('dataList').prepend(li);
                });
        });
    </script>
</body>

</html>
