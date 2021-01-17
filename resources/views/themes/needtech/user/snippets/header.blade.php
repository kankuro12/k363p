<section class="dashboard-banner">
    <div class="dash-banner-content">
        <div class="edit-btn-wrapper mx-auto mb-4">
            <div class="mx-auto dash-profile-img">
                <img src="{{asset('uploads/user/profile_img/200x200/'.$user->profile_img)}}" id="profile_img">
            </div>
            <form>
                <button type="button" class="btn" onclick="changeProfile()"><i class="fas fa-pencil-alt"></i></button>
                <input type="file" id="pf-pic" style="display: none" accept="image/*"/>
            </form>
        </div>
        <h1>Welcome, {{$user->fname}}</h1>
    </div>
 </section>
