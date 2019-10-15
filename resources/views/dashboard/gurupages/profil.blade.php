<div class="d-flex justify-content-center">
    <div class="card" style="width: 25rem;">
        <img class="card-img-top" src="/img/upacara.jpg" alt="Card image cap" style="filter:blur(1px);opacity:.8">
        <div class="card-caption" style="position: absolute;top:50px; top:0;right:0;left:0;background: rgba(0,0,0,0.6); color:white;height:210.547px;padding: 20px; box-sizing:border-box;">
          <div class="d-flex justify-content-center">
            <img id="avatar" src="{{(Auth::user()->foto != '0')? '/img/faces/'.Auth::user()->foto: ((Auth::user()->jk == 'l') ? '/img/faces/default-l.jpg' : '/img/faces/default-p.jpg')}}" alt="Avatar" class="img img-circle" style="width: 125px;border-radius:50%;margin: auto;left: 30%;border:2px solid white;box-shadow:0 0 15px rgba(255,255,255,0.6);">
            <div class="edit-foto"><i class="material-icons">edit</i></div>
            <input type="file" name="fileFoto" id="fileFoto" style="display:none;">
          </div>
          <h3 class="text-center"> <span>{{Auth::user()->fullname}}</span></h3>
        </div>
        <div class="card-body">
          <h3 class="card-title">Profil</h3>
          <table class="table">
            <tr>
              <td>NIP: </td>
              <td>{{Auth::user()->nip}}</td>
            </tr>
            <tr>
              <td>Username: </td>
              <td>{{Auth::user()->username}}</td>
            </tr>
            <tr>
              <td>Email: </td>
              <td>{{Auth::user()->email}}</td>
            </tr>
            <tr>
              <td>HP / Whatsapp: </td>
              <td>{{Auth::user()->hp}}</td>
            </tr>
          </table>
        </div>
      </div>
</div>