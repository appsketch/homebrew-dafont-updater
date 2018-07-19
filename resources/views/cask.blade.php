cask '{{ $token }}' do
  version {{ $version }}
  sha256 '{{ $sha256 }}'

  url '{{ $url }}'
  name '{{ $name }}'
  homepage '{{ $homepage }}'

@foreach ($fonts as $font)
  font '{{ $font }}'
@endforeach
end