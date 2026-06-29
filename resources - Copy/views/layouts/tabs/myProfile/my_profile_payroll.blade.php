@extends('layouts.admin')

@section('content')
    <style>
        .profile-sidebar {
            display: flex;
            flex-direction: column;
            gap: 20px;
        }

        .card-custom {
            background: #fff;
            border-radius: 12px;
            box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1);
            overflow: hidden;
            padding: 20px;
            border: 1px solid black;
        }

        /* Image Styling */
        .image-container {
            position: relative;
            width: 150px;
            height: 150px;
            margin: 0 auto 15px;
            border-radius: 50%;
            overflow: hidden;
            border: 3px solid #f8fafc;
        }

        .image-container img {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }

        /* Hover Upload Effect */
        .edit-overlay {
            position: absolute;
            bottom: 0;
            left: 0;
            right: 0;
            background: rgba(0, 0, 0, 0.6);
            height: 40px;
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            font-size: 12px;
            cursor: pointer;
            opacity: 0;
            transition: opacity 0.3s ease;
        }

        .image-container:hover .edit-overlay {
            opacity: 1;
        }

        /* Signature Styling */
        .signature-display {
            border: 1px dashed #cbd5e1;
            border-radius: 8px;
            height: 100px;
            display: flex;
            align-items: center;
            justify-content: center;
            background: #fdfdfd;
            margin-top: 10px;
            position: relative;
        }

        .signature-placeholder {
            color: #94a3b8;
            font-size: 0.85rem;
            font-style: italic;
        }
    </style>
    <?php
    // echo json_encode($my_profile_information);
    // return;
                    ?>

                    <div class="container-fluid mt-4 card-container" style="margin-bottom: 80px;">
        <div class="row">
            <div class="col-md-12">
                <div class="card shadow-sm">
                    <div class="card-body">
                        <div class="row">
                            <!-- LEFT SIDE -->
                            <div class="col-md-6 mb-4">
                                <div class="row">

                                    <!-- PROFILE CARD -->
                                    <!-- <div class="col-md-6">
                                                            <div class="card-custom">
                                                                <form method="POST" action="#" enctype="multipart/form-data">
                                                                    @csrf

                                                                    <div class="image-container">
                                                                        <img id="profilePreview" src="{{ asset('images/default-avatar.png') }}"
                                                                            alt="Profile">

                                                                        <label for="photo-upload" class="edit-overlay">
                                                                            <span> Change Photo</span>
                                                                        </label>

                                                                        <input type="file" id="photo-upload" name="photo" hidden
                                                                            accept="image/*">
                                                                    </div>

                                                                    <div class="text-center mt-2">
                                                                        <button type="submit" class="btn btn-success btn-sm d-none"
                                                                            id="savePhotoBtn">
                                                                            Save Photo
                                                                        </button>
                                                                    </div>
                                                                </form>

                                                                <div class="text-center mt-2">
                                                                    <h5 class="mb-1">Profile Picture</h5>
                                                                </div>
                                                            </div>
                                                        </div> -->

                                    <!-- SIGNATURE CARD -->
                                    <!-- <div class="col-md-6">
                                                            <div class="card-custom">

                                                                <div class="d-flex justify-content-between align-items-center mb-2">
                                                                    <strong>Signature</strong>
                                                                    <button type="button" class="btn btn-sm btn-light" id="editSignatureBtn">
                                                                        <i class="fas fa-pen-to-square"></i>
                                                                    </button>
                                                                </div>

                                                                <form method="POST" action="#" enctype="multipart/form-data">
                                                                    @csrf

                                                                    <div class="signature-display">
                                                                        <img id="signaturePreview" src=""
                                                                            style="max-height:80px; display:none;">

                                                                        <div class="signature-placeholder" id="signaturePlaceholder">
                                                                            No signature uploaded
                                                                        </div>

                                                                        <input type="file" id="signatureInput" name="signature" hidden
                                                                            accept="image/*">
                                                                    </div>

                                                                    <div class="text-end mt-2">
                                                                        <button type="submit" class="btn btn-success btn-sm d-none"
                                                                            id="saveSignatureBtn">
                                                                            Save Signature
                                                                        </button>
                                                                    </div>
                                                                </form>

                                                            </div>
                                                        </div> -->
                                </div>
                            </div>
                        </div>
                        <!-- RIGHT SIDE -->
                        <div class="col-md-12 col-lg-9">
                            <div class="card-custom position-relative">

                                <button type="button" class="btn btn-sm btn-light position-absolute edit-btn"
                                    style="top:15px; right:15px;">
                                    <i class="fas fa-pen-to-square"></i>
                                </button>

                                <h5 class="mb-3">My Information</h5>
                                <hr>

                                <form method="POST" action="#">
                                    @csrf

                                    <div class="row mb-3">
                                        <div class="col-md-3">
                                            <label><strong>Employee ID</strong></label>
                                            <input type="text" class="form-control edit-field" id="identity" name="identity"
                                                value="{{ $my_profile_information[0]->identityId}}" disabled>
                                        </div>
                                    </div>

                                    <div class="row mb-3">
                                        <div class="col-md-3">
                                            <label><strong>First Name</strong></label>
                                            <input type="email" class="form-control edit-field" id="firstName"
                                                name="firstName" value="{{ $my_profile_information[0]->firstName ?? "N/A"}}"
                                                disabled>
                                        </div>
                                        <div class="col-md-3">
                                            <label><strong>Middle Name</strong></label>
                                            <input type="text" class="form-control edit-field" id="middleName"
                                                name="middleName"
                                                value="{{ $my_profile_information[0]->middleName ?? "N/AA"}}" disabled>
                                        </div>
                                        <div class="col-md-3">
                                            <label><strong>Last Name</strong></label>
                                            <input type="text" class="form-control edit-field" id="lastName" name="lastName"
                                                value="{{ $my_profile_information[0]->lastName ?? "N/A"}}" disabled>
                                        </div>
                                        <div class="col-md-3">
                                            <label><strong>Suffix</strong></label>
                                            <input type="text" class="form-control edit-field" id="suffix" name="suffix"
                                                value="{{ $my_profile_information[0]->suffix ?? "N/A"}}" disabled>
                                        </div>
                                    </div>

                                    <div class="row mb-3">
                                        <div class="col-md-12">
                                            <label><strong>Place of Birth</strong></label>
                                            <input type="text" class="form-control edit-field" id="birthPlace"
                                                name="birthPlace"
                                                value="{{ $my_profile_information[0]->birthPlace ?? "N/A"}}" disabled>
                                        </div>
                                    </div>
                                    <div class="row mb-3">
                                        <div class="col-md-6">
                                            <label><strong>Birth Date</strong></label>
                                            <input type="text" class="form-control edit-field" id="birthdate"
                                                name="birthdate" value="{{ $my_profile_information[0]->birthdate ?? "N/A"}}"
                                                disabled>
                                        </div>
                                        <div class="col-md-6">
                                            <label><strong>Age</strong></label>
                                            <input type="text" class="form-control edit-field" id="age" name="age"
                                                value="{{ $my_profile_information[0]->age ?? "N/A"}}" disabled>
                                        </div>
                                    </div>

                                    <div class="row mb-3">
                                        <div class="col-md-12">
                                            <label><strong>Present Address</strong></label>
                                            <input type="text" class="form-control edit-field" id="address" name="address"
                                                value="{{ $my_profile_information[0]->address ?? "N/A"}}" disabled>
                                        </div>
                                    </div>
                                    <div class="row mb-3">
                                        <div class="col-md-12">
                                            <label><strong>Registered Address</strong></label>
                                            <input type="text" class="form-control edit-field" id="address2" name="address2"
                                                value="{{ $my_profile_information[0]->address2 ?? "N/A"}}" disabled>
                                        </div>
                                    </div>
                                    <div class="row mb-3">
                                        <div class="col-md-12">
                                            <label><strong>Provincial Address</strong></label>
                                            <input type="text" class="form-control edit-field" id="address3" name="address3"
                                                value="{{ $my_profile_information[0]->address3 ?? "N/A"}}" disabled>
                                        </div>
                                    </div>
                                    <div class="row mb-3">
                                        <div class="col-md-3">
                                            <label><strong>Citizenship</strong></label>
                                            <input type="email" class="form-control edit-field" id="citizenship"
                                                name="citizenship"
                                                value="{{ $my_profile_information[0]->citizenship ?? "N/A"}}" disabled>
                                        </div>
                                        <div class="col-md-3">
                                            <label><strong>Religion</strong></label>
                                            <input type="text" class="form-control edit-field" id="religion" name="religion"
                                                value="{{ $my_profile_information[0]->religion ?? "N/A"}}" disabled>
                                        </div>
                                        <div class="col-md-3">
                                            <label><strong>Gender</strong></label>
                                            <input type="text" class="form-control edit-field" id="gender" name="gender"
                                                value="{{ $my_profile_information[0]->gender ?? "N/A"}}" disabled>
                                        </div>
                                        <div class="col-md-3">
                                            <label><strong>Civil Status</strong></label>
                                            <input type="text" class="form-control edit-field" id="civilStatus"
                                                name="civilStatus"
                                                value="{{ $my_profile_information[0]->civilStatus ?? "N/A"}}" disabled>
                                        </div>
                                    </div>
                                    <div class="row mb-3">
                                        <div class="col-md-6">
                                            <label><strong>Contact Number</strong></label>
                                            <input type="text" class="form-control edit-field" id="contactNo"
                                                name="contactNo" value="{{ $my_profile_information[0]->contactNo ?? "N/A"}}"
                                                disabled>
                                        </div>
                                        <div class="col-md-6">
                                            <label><strong>Email Address</strong></label>
                                            <input type="text" class="form-control edit-field" id="emailAddress"
                                                name="emailAddress"
                                                value="{{ $my_profile_information[0]->emailAddress ?? "N/A"}}" disabled>
                                        </div>
                                    </div>
                                    <br>
                                    <br>
                                   
                                    <div class="text-end">
                                        <button type="submit" class="btn btn-success save-btn d-none">
                                            Save Changes
                                        </button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection


