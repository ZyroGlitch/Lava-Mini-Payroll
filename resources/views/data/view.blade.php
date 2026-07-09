<!DOCTYPE html>
<html>

<head>
    <title>View Data (Live)</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body>
    <div class="container mt-5">
        <h3>Live Data Feed</h3>

        <ul id="dataList" class="list-group">
            @foreach ($items as $item)
                <li class="list-group-item">{{ $item->name }}</li>
            @endforeach
        </ul>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
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
