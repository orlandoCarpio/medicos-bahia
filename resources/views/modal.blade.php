<div class="modal fade" id="modalGlobal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="title-modal">Titulos</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
       <div id="content-modal">
          <div id="create-new-bill-div">
            @include('formularios.newBill')
          </div>
          <div id="login-div">
            @include('formularios.login')
          </div>

       </div>
      </div>
    </div>
  </div>
</div>