<h1>Listings</h1>

<h2>{{ $heading }}</h2>

@foreach($listings as $listing)
    <p>$listing['title']</p>
    <p>$listing['description']</p>

@endforeach
