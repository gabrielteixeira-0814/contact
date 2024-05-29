<!doctype html>
<html lang="pt-br">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css" integrity="sha384-xOolHFLEh07PJGoPkLv1IbcEPTNtaed2xpHsD9ESMhqIYd0nLMwNLD69Npy4HI+N" crossorigin="anonymous">
    <link href="public/assets/css/style.css" rel="stylesheet">

    <title>Contatos</title>
  </head>
  <body class="">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-3 bg-white rounded  shadow-lg p-5">
            <h1>Hello, world!</h1>
                <div class="mt-5">
                    <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal">Usuário +</button>
                </div>
              
                <div class="mt-3">
                    <form>
                        <div class="form-group">
                            <label for="exampleFormControlSelect1">Usuários</label>
                            <select class="form-control" id="exampleFormControlSelect1">
                            <option>1</option>
                            <option>2</option>
                            <option>3</option>
                            <option>4</option>
                            <option>5</option>
                            </select>
                        </div>
                    </form>
                </div>
                <div class="mt-4">
                    <a class="button-contact" target="_blank" href="https://dashboardpack.com/theme-details/analytic-dashboard/">
                        <span>:=</span>
                        <span>Contatos</span>
                    </a>
                </div>
                <div class="mt-4">
                    <a class="button-list-contact" target="_blank" href="https://dashboardpack.com/theme-details/analytic-dashboard/">
                        <span>:=</span>
                        <span>Lista de Contatos</span>
                    </a>
                </div>
            </div>
            <div class="col-md-9" id="app">
              <div class="row justify-content-center mt-5">
                <div class="col-md-8 bg-white rounded  shadow-lg p-5">
                  <h2>Agenda de Contatos - Criar Contato</h2>

                  <div class="border rounded p-3 mt-5">
                    <form @submit.prevent="onSubmit" >
                      <div class="form-row">
                        <div class="form-group col-md-6">
                          <label for="inputEmail4">Nome</label>
                          <input type="text" v-model="name" class="form-control">
                        </div>
                        <!-- <div class="form-group col-md-6">
                          <label for="inputEmail4">Email</label>
                          <input type="email" v-model="name" class="form-control" id="inputEmail4">
                        </div> -->
                        <!-- <div class="form-group col-md-6">
                          <label for="inputPassword4">Password</label>
                          <input type="password" class="form-control" id="inputPassword4">
                        </div>
                      </div>
                      <div class="form-group">
                        <label for="inputAddress">Address</label>
                        <input type="text" class="form-control" id="inputAddress" placeholder="1234 Main St">
                      </div>
                      <div class="form-group">
                        <label for="inputAddress2">Address 2</label>
                        <input type="text" class="form-control" id="inputAddress2" placeholder="Apartment, studio, or floor">
                      </div>
                      <div class="form-row">
                        <div class="form-group col-md-6">
                          <label for="inputCity">City</label>
                          <input type="text" class="form-control" id="inputCity">
                        </div>
                        <div class="form-group col-md-4">
                          <label for="inputState">State</label>
                          <select id="inputState" class="form-control">
                            <option selected>Choose...</option>
                            <option>...</option>
                          </select>
                        </div>
                        <div class="form-group col-md-2">
                          <label for="inputZip">Zip</label>
                          <input type="text" class="form-control" id="inputZip">
                        </div>
                      </div>
                      <div class="form-group">
                        <div class="form-check">
                          <input class="form-check-input" type="checkbox" id="gridCheck">
                          <label class="form-check-label" for="gridCheck">
                            Check me out
                          </label>
                        </div>
                      </div> -->
                      <button class="btn btn-primary">Salvar</button>
                    </form>
                  </div>
                </div>
              </div>

              <!-- <div class="row justify-content-center my-5">
                <div class="col-md-8 bg-white rounded  shadow-lg p-5">
                  <h2>Agenda de Contatos - Lista de Contatos</h2>

                  <div class="border rounded p-3 mt-5">
                    <form>
                      <div class="form-row">
                        <div class="form-group col-md-6">
                          <label for="inputEmail4">Email</label>
                          <input type="email" class="form-control" id="inputEmail4">
                        </div>
                        <div class="form-group col-md-6">
                          <label for="inputPassword4">Password</label>
                          <input type="password" class="form-control" id="inputPassword4">
                        </div>
                      </div>
                      <div class="form-group">
                        <label for="inputAddress">Address</label>
                        <input type="text" class="form-control" id="inputAddress" placeholder="1234 Main St">
                      </div>
                      <div class="form-group">
                        <label for="inputAddress2">Address 2</label>
                        <input type="text" class="form-control" id="inputAddress2" placeholder="Apartment, studio, or floor">
                      </div>
                      <div class="form-row">
                        <div class="form-group col-md-6">
                          <label for="inputCity">City</label>
                          <input type="text" class="form-control" id="inputCity">
                        </div>
                        <div class="form-group col-md-4">
                          <label for="inputState">State</label>
                          <select id="inputState" class="form-control">
                            <option selected>Choose...</option>
                            <option>...</option>
                          </select>
                        </div>
                        <div class="form-group col-md-2">
                          <label for="inputZip">Zip</label>
                          <input type="text" class="form-control" id="inputZip">
                        </div>
                      </div>
                      <div class="form-group">
                        <div class="form-check">
                          <input class="form-check-input" type="checkbox" id="gridCheck">
                          <label class="form-check-label" for="gridCheck">
                            Check me out
                          </label>
                        </div>
                      </div>
                      <button type="submit" class="btn btn-primary">Salvar</button>
                    </form>
                  </div>
                </div>
              </div> -->
            </div>
        </div>
    </div>

    <!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Criar usuário</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
      <form>
            <div class="form-group">
                <label for="exampleInputEmail1">Email address</label>
                <input type="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp">
                <small id="emailHelp" class="form-text text-muted">We'll never share your email with anyone else.</small>
            </div>
            <div class="form-group">
                <label for="exampleInputPassword1">Password</label>
                <input type="password" class="form-control" id="exampleInputPassword1">
            </div>
        </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Fechar</button>
        <button type="button" class="btn btn-primary">Salvar</button>
      </div>
    </div>
  </div>
</div>

  <!-- Optional JavaScript; choose one of the two! -->
  <script src="https://unpkg.com/vue@3/dist/vue.global.js"></script>

<!-- Option 1: jQuery and Bootstrap Bundle (includes Popper) -->
<script src="https://cdn.jsdelivr.net/npm/jquery@3.5.1/dist/jquery.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-Fy6S3B9q64WdZWQUiU+q4/2Lc9npb8tCaSX9FK7E8HnRr0Jz8D6OP9dO5Vg3Q9ct" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>

<!-- Inicialização do Vue no final do corpo -->
<script>
  const { createApp } = Vue;

  createApp({
    data() {
      return {
        name: ''
      }
    },
    methods: {
      onSubmit() {
       if (this.name !== '') {
        var fd = new FormData()

        fd.append('name', this.name);

        axios({
          url: '/contact/web/users',
          method: 'get',
          data: fd
        })
        .then(res => {
          console.log(res.data)
        })
        .catch(err => {
          console.log(err);
        })
       }
      }
    }
  }).mount('#app');

</script>

  </body>
</html>
