@extends('admin.layouts.admin')

@section('content')
    <div class="admin-container">
        {{-- FIX: enctype="multipart/form-data" is REQUIRED for file uploads --}}
        <form action="{{ route('admin.about.update') }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')

            <header class="admin-header">
                <div class="header-info">
                    <h2>Edit About</h2>
                    <p>Update your About profile, photo, contact details and language.</p>
                </div>
                <button type="submit" class="btn-save">Save Changes</button>
            </header>

            @if (session('success'))
                <div class="admin-alert success">{{ session('success') }}</div>
            @endif

            @if ($errors->any())
                <div class="admin-alert error">
                    <ul class="mb-0">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <div class="bento-grid">
                <div class="bento-col">
                    <div class="card photo-card">
                        <label class="card-label">01 // PROFILE_IMAGE</label>
                        <div class="photo-edit-area">
                            <div class="photo-frame">
                                <img src="{{ isset($about) && $about->photo_path ? asset($about->photo_path) : 'https://cilisos.my/wp-content/uploads/2016/07/unknown-person-icon-Image-from.png' }}"
                                    alt="Profile" id="admin-preview">
                                <div class="photo-glow"></div>
                            </div>
                            <input type="file" name="photo" id="upload-photo" accept="image/jpeg,image/png,image/jpg,image/webp" hidden onchange="previewImage(event)">
                            <label for="upload-photo" class="btn-outline">Update Photo</label>
                            @error('photo')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>
                    </div>

                    <div class="card">
                        <label class="card-label">02 // CONTACT_INFO</label>
                        <div class="input-group">
                            <label>Phone</label>
                            <input type="text" name="phone" value="{{ old('phone', $about->phone ?? '') }}">
                            @error('phone') <small class="text-danger">{{ $message }}</small> @enderror
                        </div>
                        <div class="input-group">
                            <label>Email</label>
                            <input type="email" name="email" value="{{ old('email', $about->email ?? '') }}">
                            @error('email') <small class="text-danger">{{ $message }}</small> @enderror
                        </div>
                        <div class="input-group">
                            <label>Language</label>
                            <input type="text" name="language" value="{{ old('language', $about->language ?? '') }}"
                                placeholder="English, Urdu, etc.">
                        </div>
                        <div class="input-group">
                            <label>Resume / CV</label>
                            <input type="file" name="cv" accept=".pdf,.doc,.docx">
                            @if (isset($about) && $about->cv_path)
                                <small>Current file: <a href="{{ asset($about->cv_path) }}" target="_blank">Download CV</a></small>
                            @endif
                            @error('cv') <small class="text-danger">{{ $message }}</small> @enderror
                        </div>
                        <div class="input-group">
                            <label>Birthday</label>
                            <input type="text" name="birthday" value="{{ old('birthday', $about->birthday ?? '') }}"
                                placeholder="Jan 01, 2000">
                        </div>
                        <div class="input-group">
                            <label>Location</label>
                            <input type="text" name="location" value="{{ old('location', $about->location ?? '') }}"
                                placeholder="Karachi, Pakistan">
                        </div>
                        <div class="input-group">
                            <label>Freelance Status</label>
                            <input type="text" name="freelance_status"
                                value="{{ old('freelance_status', $about->freelance_status ?? '') }}"
                                placeholder="Available / Unavailable">
                        </div>
                    </div>
                </div>

                <div class="bento-col">
                    <div class="card">
                        <label class="card-label">03 // CONTENT</label>
                        <div class="input-group">
                            <label>Heading</label>
                            <input type="text" name="heading" value="{{ old('heading', $about->heading ?? '') }}">
                            @error('heading') <small class="text-danger">{{ $message }}</small> @enderror
                        </div>
                        <div class="input-group">
                            <label>Role</label>
                            <input type="text" name="role" value="{{ old('role', $about->role ?? '') }}">
                            @error('role') <small class="text-danger">{{ $message }}</small> @enderror
                        </div>
                        <div class="input-group">
                            <label>Description</label>
                            <textarea name="description" rows="10">{{ old('description', $about->description ?? '') }}</textarea>
                            @error('description') <small class="text-danger">{{ $message }}</small> @enderror
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>

    <script>
        function previewImage(event) {
            var reader = new FileReader();
            reader.onload = function() {
                document.getElementById('admin-preview').src = reader.result;
            };
            reader.readAsDataURL(event.target.files[0]);
        }
    </script>
@endsection