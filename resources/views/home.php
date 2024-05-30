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
        <div class="row" id="app">
            <div class="col-md-3 bg-white rounded  shadow-lg p-5">
              <h1>Welcome</h1>
              <div class="mt-5">
                  <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#userModal">Usuário +</button>
              </div>
              <div class="mt-3">
                  <form>
                      <div class="form-group">
                          <label for="selectUsers">Usuários</label>
                          <select class="form-control" id="selectUsers">
                            <option v-for="user in userslist" :key="user.id" :value="user.id">{{ user.name }} - {{ user.email }}</option>
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
            <div class="col-md-9">
              <div class="row justify-content-center mt-5">
                <div class="col-md-8 bg-white rounded  shadow-lg p-5">
                  <h2>Create Contact</h2>

                  <div class="border rounded p-3 mt-5">
                    <form @submit.prevent="onSubmit">
                        <div class="form-row">
                          <div class="form-group col-md-6">
                            <label for="inputEmail4">Name</label>
                            <input type="text" v-model="contactName" class="form-control">
                          </div>
                          <div class="form-group col-md-6">
                            <label for="inputEmail">Email</label>
                            <input type="email" v-model="contactEmail" class="form-control" id="inputEmail">
                          </div>
                        </div>
                        <div class="form-group">
                          <label for="inputAddress">Address</label>
                          <input type="text" v-model="contactPublic_place" class="form-control" id="inputAddress" placeholder="Main St">
                        </div>
                        <div class="form-group">
                          <label for="inputNeighborhood">Neighborhood</label>
                          <input type="text" v-model="contactNeighborhood" class="form-control" id="inputNeighborhood">
                        </div>
                        <div class="form-row">
                          <div class="form-group col-md-2">
                            <label for="inputNumber">Number</label>
                            <input type="text" v-model="contactNumber" class="form-control" id="inputNumber">
                          </div>
                          <div class="form-group col-md-4">
                            <label for="inputCity">City</label>
                            <input type="text" v-model="contactCity" class="form-control" id="inputCity">
                          </div>
                          <div class="form-group col-md-4">
                            <label for="inputState">State</label>
                            <select id="inputState" v-model="ContactState" class="form-control">
                              <option selected>Select</option>
                              <option value="RJ">RJ</option>
                              <option value="RS">RS</option>
                              <option value="MG">MG</option>
                              <option value="SP">SP</option>
                            </select>
                          </div>
                        </div>
                      <button class="btn btn-primary">Save</button>
                    </form>
                  </div>
                </div>
              </div>
            </div>
            <!-- Modal -->
            <div class="modal fade" id="userModal" tabindex="-1" aria-labelledby="userModalLabel" aria-hidden="true">
              <div class="modal-dialog">
                <div class="modal-content">
                  <div class="modal-header">
                    <h5 class="modal-title" id="userModalLabel">Criar usuário</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                      <span aria-hidden="true">&times;</span>
                    </button>
                  </div>
                  <div class="modal-body">
                    <form @submit.prevent="createUser">
                      <div class="form-group">
                          <label for="name">Nome</label>
                          <input type="email" class="form-control" v-model="userName">
                      </div>
                      <div class="form-group">
                          <label for="email">E-mail</label>
                          <input type="email" class="form-control" v-model="email">
                      </div>
                      <div class="form-group">
                          <label for="password">Senha</label>
                          <input type="password" class="form-control" v-model="password">
                      </div>
                      <div class="form-group">
                          <label for="password_confirmation">Confirma senha</label>
                          <input type="password" class="form-control" v-model="password_confirmation">
                      </div>
                    </form>
                  </div>
                  <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Fechar</button>
                    <button type="button" class="btn btn-primary" @click="createUser()">Salvar</button>
                  </div>
                </div>
              </div>
            </div>
          </div>
      </div>

    <script src="https://unpkg.com/vue@3/dist/vue.global.js"></script>

    <script src="https://cdn.jsdelivr.net/npm/jquery@3.5.1/dist/jquery.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-Fy6S3B9q64WdZWQUiU+q4/2Lc9npb8tCaSX9FK7E8HnRr0Jz8D6OP9dO5Vg3Q9ct" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>

    <script>
      const { createApp } = Vue;

      createApp({
        data() {
          return {
            name: '',
            userName: '',
            email: '',
            password: '',

            contactName: '',
            contactEmail: '',
            contactPublic_place: '',
            contactNeighborhood: '',
            contactNumber: '',
            contactCity: '',
            ContactState: '',

            userslist: []
          }
        },
        methods: {
          onSubmit() {
            console.log(this.contactName);
            console.log(this.contactEmail);
            console.log(this.contactPublic_place);
            console.log(this.contactNeighborhood);
            console.log(this.contactNumber);
            console.log(this.contactCity);
            console.log(this.ContactState);

            if (this.contactName !== '' &&
                this.contactEmail !== '' &&
                this.contactPublic_place !== '' &&
                this.contactNeighborhood !== '' &&
                this.contactNumber !== '' &&
                this.contactCity !== '' &&
                this.ContactState
              ) {
              var fd = new FormData()

              const data = {
                name: this.contactName,
                email: this.contactEmail,
                public_place: this.contactPublic_place,
                neighborhood: this.contactNeighborhood,
                number: this.contactNumber,
                city: this.contactCity,
                state: this.ContactState
              };

              axios.post('/contact/web/contact/create', data)
                .then(res => {
                  if (res.data.success) {
                    console.log(res);
                    //alert('Contact created successfully');
                  }                
                })
                .catch(err => {
                  console.log(err);
                  //alert(err.response.data.message);
                });
            }
          },
          createUser() {
            if (this.userName !== '' &&
                this.email !== '' &&
                this.password !== '' &&
                this.password_confirmation !== ''
              ) {
              var fd = new FormData()

              const data = {
                name: this.userName,
                email: this.email,
                password: this.password,
                password_confirmation: this.password_confirmation
              };

              axios.post('/contact/web/users/create', data)
                .then(res => {
                  if (res.data.success) {
                    alert('User created successfully');
                  }                
                })
                .catch(err => {
                  alert(err.response.data.message);
                });
            }
          },
          getUsers() {
            axios.get('/contact/web/users')
              .then(res => {
                if (res.data.success) {
                  this.userslist = res.data.data;
                  console.log(res.data.data);
                }                
              })
              .catch(err => {
                console.log(err);
              });
          }
        },
        mounted() {
          this.getUsers();
        }
      }).mount('#app');

    </script>
  </body>
</html>
