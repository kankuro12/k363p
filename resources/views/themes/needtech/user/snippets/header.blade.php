@php
    $user1=Auth::user()->vendoruser;
@endphp
<section class="dashboard-banner">
    <div class="dash-banner-content">
        <div class="edit-btn-wrapper mx-auto mb-4">
            <div class="mx-auto dash-profile-img">
                <img src="{{asset($user1->profile_img)}}" id="profile_img">
            </div>
            <form>
                <button type="button" class="btn" onclick="changeProfile()"><i class="fas fa-pencil-alt"></i></button>
                <input type="file" id="pf-pic" style="display: none" accept="image/*"/>
            </form>
        </div>
        <h1>Welcomexx, {{$user1->fname}}</h1>
    </div>
 </section>
