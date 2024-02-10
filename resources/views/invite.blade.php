@extends('layouts.app')

@section('content')
    <div class="container">
        <h2>Send Invite</h2>

        <form id="invite-form" method="POST" action="{{ route('send-invite') }}">
            @csrf

            {{-- Invitee Information --}}
            <div class="form-group">
                <label for="name">Name:</label>
                <input type="text" name="name" id="name" class="form-control" value="{{ old('name') }}">
                @error('name')
                    <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                @enderror
            </div>

            <div class="form-group">
                <label for="email">Email Address:</label>
                <input type="email" name="email" id="email" class="form-control" required>
                @error('email')
                    <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                @enderror
            </div>

            {{-- Relationship Selector --}}
            <div class="form-group">
                <label for="relationship">Relationship:</label>
                <select name="relationship" id="relationship" class="form-control" required>
                    <option value="">Select Relationship</option>
                    @foreach ($relationships as $relationship)
                        <option value="{{ $relationship->id }}">{{ $relationship->relationship_title }}</option>
                    @endforeach
                </select>
            </div>

            {{-- Family Tree Builder (Conditional) --}}
            <div id="family-tree-builder" class="d-none">
                {{-- Implement here using JavaScript framework of your choice --}}
            </div>

            <button type="submit" class="btn btn-primary">Send Invite</button>
        </form>
    </div>
@endsection

@push('scripts')
    <script src="{{ asset('js/invite-form.js') }}"></script>
@endpush
