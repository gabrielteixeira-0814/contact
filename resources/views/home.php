<!doctype html>
<html lang="pt-br">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

   <!-- Bootstrap CSS -->
   <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css" integrity="sha384-xOolHFLEh07PJGoPkLv1IbcEPTNtaed2xpHsD9ESMhqIYd0nLMwNLD69Npy4HI+N" crossorigin="anonymous">
    <link href="public/assets/css/style.css" rel="stylesheet">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.0/css/all.css" integrity="sha384-lZN37f5QGtY3VHgisS14W3ExzMWZxybE1SJSEsQp9S+oqd12jhcu+A56Ebc1zFSJ" crossorigin="anonymous">
    <link href="https://cdn.datatables.net/1.11.5/css/dataTables.bootstrap4.min.css" rel="stylesheet">

    <title>Contatos</title>
  </head>
  <body class="">
    <div class="container-fluid">
        <div class="row" id="app">
            <div class="col-md-3 bg-white rounded  shadow-lg p-5">
              <h1>Welcome</h1>
              <div class="mt-5">
                  <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#userModal">User +</button>
              </div>
              <div class="mt-3">
                  <form>
                      <div class="form-group">
                          <label for="selectUsers">Users</label>
                          <select class="form-control" v-model="selectedUser" @change="getUserContacts(selectedUser)">
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
                  <div class="row align-items-center justify-content-between px-3">
                    <div>
                      <h2>Create Contact</h2>
                    </div>
                    <div v-if="userNameTitle">
                      <i class="fas fa-user" style="font-size: 20px;"></i>
                      <span class="font-weight-bold pl-2">{{ userNameTitle }}</span>
                    </div>
                  </div>
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
                <div class="col-md-8 bg-white rounded  shadow-lg p-5 my-5">
                  <h2>Lista Contacts</h2>
                  <div class="border rounded p-3 mt-5">
                    <div>
                      <p v-for="contact in contactList" :key="contact.id" :value="contact.id">{{ contact.name }} - {{ contact.email }}</p>
                    </div>
                    <div>
                    <table id="example" class="table table-striped table-bordered" style="width:100%">
                      <thead>
                      <tr>
                        <th scope="col">#</th>
                        <th scope="col">Name</th>
                        <th scope="col">E-mail</th>
                        <th scope="col">Tipo</th>
                        <th scope="col">Status</th>
                        <th scope="col">Ações</th>
                      </tr>
                    </thead>
                    <tbody>
                        <!-- @foreach ($users as $user) -->
                        <tr>
                          <th scope="row">ola</th>

                            <!-- <th scope="row">{{ $user->id ?? '-' }}</th>
                            <td>{{ $user->name ?? '-' }}</td>
                            <td>{{ $user->email ?? '-' }}</td>
                            <td>{{ $user->usersType->name ?? '-' }}</td>
                            <td>{{ $user->is_enabled ? 'Ativo' :  'Inativo' }}</td>
                            <td>
                                <a href='{{route('user.show',$user->id)}}' class='btn btn-secondary btn-sm'><i class="bi bi-eye-fill"></i></a>
                                <a href='{{route('user.edit',$user->id)}}' class='btn btn-success btn-sm'><i class="bi bi-pencil"></i></a>
                                <a href="{{route('delete_user',$user->id)}}" class='btn btn-danger btn-sm'><i class="bi bi-trash-fill"></i></a>
                            </td> -->
                          </tr>
                        <!-- @endforeach -->
                      </tbody>
                    </table>
                    </div>
                  </div>
                </div>


              </div>
            </div>
            <!-- Modal -->
            <div class="modal fade" id="userModal" tabindex="-1" aria-labelledby="userModalLabel" aria-hidden="true">
              <div class="modal-dialog">
                <div class="modal-content">
                  <div class="modal-header">
                    <h5 class="modal-title" id="userModalLabel">Create User</h5>
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
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary" @click="createUser()">Save</button>
                  </div>
                </div>
              </div>
            </div>

             <!-- gif -->
            <div v-if="isLoading" class="loading">
              <div class="c-loader"></div>
            </div>

          </div>
      </div>

    <script src="https://unpkg.com/vue@3/dist/vue.global.js"></script>

    <script src="https://cdn.jsdelivr.net/npm/jquery@3.5.1/dist/jquery.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-Fy6S3B9q64WdZWQUiU+q4/2Lc9npb8tCaSX9FK7E8HnRr0Jz8D6OP9dO5Vg3Q9ct" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>

    <script src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.11.5/js/dataTables.bootstrap4.min.js"></script>
    <script src="https://cdn.datatables.net/plug-ins/1.10.25/i18n/Portuguese.json"></script>

    <script>
      const { createApp } = Vue;

      createApp({
        data() {
          return {
            selectedUser: '',
            userNameTitle: '',

            // Input User
            name: '',
            userName: '',
            email: '',
            password: '',

            // Input Contact
            contactName: '',
            contactEmail: '',

            // Input Address
            contactPublic_place: '',
            contactNeighborhood: '',
            contactNumber: '',
            contactCity: '',
            ContactState: '',

            userslist: [],
            contactList: [],

            isLoading: false
          }
        },
        methods: {
          
          async onSubmit() {
            this.isLoading = true;

            if (this.contactName !== '' && this.contactEmail !== '' && this.selectedUser !== '') {
                const data = {
                  user_id: this.selectedUser,
                  name: this.contactName,
                  email: this.contactEmail
                };

                console.log(data);

                try {
                  const res = await axios.post('/contact/web/contact/create', data);

                  if (res.data.success) {
                    if (res.data.data.id) {

                      this.createAddress(res.data.data.id)
                        .then(result => {
                          if (result) {
                            console.log("The address was created successfully");
                          } else {
                            console.log("Unable to create address");
                          }

                        })
                        .catch(error => {
                          console.error("Erro ao executar a promise:", error);
                        });
                    }

                    this.isLoading = false;
                    alert('Contact created successfully');
                    this.selectedUser = '';
                    this.contactName = '';
                    this.contactEmail = '';
                  }
                } catch (err) {
                  this.isLoading = false;
                  alert(err.response.data.message);
                }
            } else {
              this.isLoading = false;
              alert('Sorry, please check that all data has been filled in');
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

                    this.userName = '';
                    this.email = '';
                    this.password = '';
                    this.password_confirmation = '';
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
          },
          async createAddress(contactId) {
            
            if (this.contactPublic_place !== '' &&
                this.contactNeighborhood !== '' &&
                this.contactNumber !== '' &&
                this.contactCity !== '' &&
                this.ContactState
              ) { 

              const data = {
                contact_id: contactId,
                number: this.contactNumber,
                public_place: this.contactPublic_place,
                neighborhood: this.contactNeighborhood,
                city: this.contactCity,
                state: this.ContactState
              };

              try {
                  const res = await axios.post('/contact/web/address/create', data);

                  if (res.data.success) {
                    console.log('Adrress created successfully');
                    this.contactNumber = '';
                    this.contactPublic_place = '';
                    this.contactNeighborhood = '';
                    this.contactCity = '';
                    this.ContactState = '';

                    return true;
                  }
              } catch (err) {
                console.log(err.response.data.message);

                return false;
              }
            }
          },

          async getUserContacts(userId) {
              console.log(userId, 'ola aqui');
              try {
                  const res = await axios.get(`/contact/web/users/${userId}`); 

                  if (res.data.success) {
                    this.userNameTitle = res.data.message.name;
                    this.contactList = res.data.message.contacts;
                    console.log(res.data.message.name);
                    console.log(res.data.message.contacts);
                  } 
              } catch (err) {
                  console.log(err.data.message);
              }
          }
        },
        watch: {
          selectedUser(newVal) {
            console.log('User selected:', newVal);
          }
        },
        mounted() {
          this.getUsers();
        }
      }).mount('#app');

      $(document).ready(function() {
        $('#example').DataTable({
            "columnDefs": [
                { "width": "3%", "targets": 0, "className": "dt-center"  }, // Defina a largura da primeira coluna
                { "width": "30%", "targets": 1, "className": "dt-center"  },
                { "width": "35%", "targets": 2 },
                { "width": "12%", "targets": 3, "className": "dt-center"  },
                { "width": "10%", "targets": 4, "className": "dt-center"  },
                // Adicione mais definições de largura conforme necessário para outras colunas
            ],
            "language": {
                "sEmptyTable":     "Nenhum dado encontrado na tabela",
                "sInfo":           "Mostrando de _START_ até _END_ de _TOTAL_ registros",
                "sInfoEmpty":      "Mostrando 0 até 0 de 0 registros",
                "sInfoFiltered":   "(Filtrados de _MAX_ registros)",
                "sInfoPostFix":    "",
                "sInfoThousands":  ".",
                "sLengthMenu":     "Mostrar _MENU_ resultados por página",
                "sLoadingRecords": "Carregando...",
                "sProcessing":     "Processando...",
                "sZeroRecords":    "Nenhum registro encontrado",
                "sSearch":         "Pesquisar",
                "oPaginate": {
                    "sNext":     "Próximo",
                    "sPrevious": "Anterior",
                    "sFirst":    "Primeiro",
                    "sLast":     "Último"
                },
                "oAria": {
                    "sSortAscending":  ": Ordenar colunas de forma ascendente",
                    "sSortDescending": ": Ordenar colunas de forma descendente"
                }
            }
        });
    });
    </script>
  </body>
</html>
