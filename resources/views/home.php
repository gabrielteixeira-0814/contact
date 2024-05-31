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
                          <label for="selectUsers" class="font-weight-bold">Users</label>
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
                    <div class="my-5">
                        <table id="example" class="table table-striped table-bordered text-center" style="width:100%">
                          <thead>
                          <tr>
                            <th scope="col">Name</th>
                            <th scope="col">E-mail</th>
                            <th scope="col">Actions</th>
                          </tr>
                        </thead>
                        <tbody>
                        <tr v-for="contact in contactList" :key="contact.id" :value="contact.id">
                          <td>{{ contact.name }}</td>
                          <td>{{ contact.email }}</td>
                            <td>
                                <a href="#" class='btn btn-secondary btn-sm mr-1' data-toggle="modal" data-target="#phoneListModal" @click="getContactPhones(contact.id)"><i class="fa fa-phone-square" style="font-size: 13px;"></i></a>
                                <a href="#" class='btn btn-primary btn-sm mr-1' data-toggle="modal" data-target="#phoneModal" @click="getContact(contact.id)"><i class="fa fa-phone" style="font-size: 13px;" ></i></a>
                                <a href="#" class='btn btn-success btn-sm mr-1' data-toggle="modal" data-target="#editContactModal" @click="getContact(contact.id)">
                                  <i class="fa fa-align-justify" style="font-size: 13px;"></i>
                                </a>
                                <a href="#" class='btn btn-danger btn-sm' @click="deleteContact(contact.id, userIdReloadTable)"><i class="fa fa-trash" style="font-size: 13px;"></i></a>
                            </td>
                        </tr>
                        </tbody>
                      </table>
                    </div>
                </div>


              </div>
            </div>

            <!-- Modal User -->
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

            <!-- Modal Edit Contact -->
            <div class="modal fade" id="editContactModal" tabindex="-1" aria-labelledby="editContactLabel" aria-hidden="true">
              <div class="modal-dialog">
                <div class="modal-content">
                  <div class="modal-header">
                    <h5 class="modal-title" id="editContactLabel">Edit Contact</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                      <span aria-hidden="true">&times;</span>
                    </button>
                  </div>
                  <div class="modal-body">
                  <form @submit.prevent="updateContact">
                        <div class="form-row">
                          <div class="form-group col-md-6">
                            <label for="inputEmail4">Name</label>
                            <input type="text" v-model="editContactName" class="form-control">
                          </div>
                          <div class="form-group col-md-6">
                            <label for="inputEmail">Email</label>
                            <input type="email" v-model="editContactEmail" class="form-control" id="inputEmail">
                          </div>
                        </div>
                        <div class="form-group">
                          <label for="inputAddress">Address</label>
                          <input type="text" v-model="editContactPublic_place" class="form-control" id="inputAddress" placeholder="Main St">
                        </div>
                        <div class="form-group">
                          <label for="inputNeighborhood">Neighborhood</label>
                          <input type="text" v-model="editContactNeighborhood" class="form-control" id="inputNeighborhood">
                        </div>
                        <div class="form-row">
                          <div class="form-group col-md-2">
                            <label for="inputNumber">Number</label>
                            <input type="text" v-model="editContactNumber" class="form-control" id="inputNumber">
                          </div>
                          <div class="form-group col-md-4">
                            <label for="inputCity">City</label>
                            <input type="text" v-model="editContactCity" class="form-control" id="inputCity">
                          </div>
                          <div class="form-group col-md-6">
                            <label for="inputState">State</label>
                            <select id="inputState" v-model="editContactState" class="form-control">
                              <option selected>Select</option>
                              <option value="RJ">RJ</option>
                              <option value="RS">RS</option>
                              <option value="MG">MG</option>
                              <option value="SP">SP</option>
                            </select>
                          </div>
                        </div>
                    </form>
                  </div>
                  <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary" @click="updateContact(editContactId, editAddressId)">Save</button>
                  </div>
                </div>
              </div>
            </div>

            <!-- Modal Phone -->
            <div class="modal fade" id="phoneModal" tabindex="-1" aria-labelledby="phoneModalLabel" aria-hidden="true">
              <div class="modal-dialog">
                <div class="modal-content">
                  <div class="modal-header">
                    <h5 class="modal-title" id="phoneModalLabel">Create Phone</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                      <span aria-hidden="true">&times;</span> 
                    </button>
                  </div>
                  <div class="modal-body">
                    <form @submit.prevent="createPhones">
                      <div class="form-group">
                          <label for="number">Number</label>
                          <input type="text" class="form-control" v-model="number">
                      </div>
                    </form>
                  </div>
                  <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary" @click="createPhones(getContactId)">Save</button>
                  </div>
                </div>
              </div>
            </div>

              <!-- Modal Phone List -->
            <div class="modal fade" id="phoneListModal" tabindex="-1" aria-labelledby="phoneListModalLabel" aria-hidden="true">
              <div class="modal-dialog modal-lg">
                <div class="modal-content">
                  <div class="modal-header">
                    <h5 class="modal-title" id="phoneListModalLabel">Phone list</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                      <span aria-hidden="true">&times;</span> 
                    </button>
                  </div>
                  <div class="modal-body">
                    <div class="row">
                      <div class="col-md-12 p-3">
                        <h4>{{ contactNameTitle }}</h4>
                        <div class="my-5">
                            <table id="example" class="table table-striped table-bordered text-center" style="width:100%">
                              <thead>
                              <tr>
                                <th scope="col">Number</th>
                                <th scope="col">Actions</th>
                              </tr>
                            </thead>
                            <tbody>
                            <tr v-for="phone in phoneList" :key="phone.id" :value="phone.id">
                              <td>{{ phone.number }}</td>
                                <td>
                                    <a href="#" class='btn btn-danger btn-sm' @click="deletePhone(phone.id, contactIdReloadTable)"><i class="fa fa-trash" style="font-size: 13px;"></i></a>
                                </td>
                            </tr>
                            </tbody>
                          </table>
                        </div>
                      </div>
                    </div>
                  </div>
                  <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary" @click="createPhones(getContactId)">Save</button>
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

    <script src="https://code.jquery.com/jquery-3.5.1.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/vue@3/dist/vue.global.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js"></script>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.11.5/js/dataTables.bootstrap4.min.js"></script>

    <script>
        new DataTable('#example');
    </script>

    <script>
      const { createApp } = Vue;

      createApp({
        data() {
          return {
            selectedUser: '',
            userNameTitle: '',
            contactNameTitle: '',
            userIdReloadTable: '',
            contactIdReloadTable: '',

            getContactId: '',

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

            // Input Phone
            number: '',

            // Edit Contact
            editContactId: '',
            editContactName: '',
            editContactEmail: '',

            // Edit Address
            editAddressId: '',
            editContactPublic_place: '',
            editContactNeighborhood: '',
            editContactNumber: '',
            editContactCity: '',
            editContactState: '',

            userslist: [],
            contactList: [],
            phoneList: [],

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

                try {
                  const res = await axios.post('/contact/web/contact/create', data);

                  if (res.data.success) {
                    if (res.data.data.id) {

                      this.updateAddress(res.data.data.id)
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
          async getContact(contactId) {
              try {
                  const res = await axios.get(`/contact/web/contact/${contactId}`); 

                  if (res.data.success) {
                    this.getContactId= res.data.message.id;

                    // Input Contact
                    this.editContactId= res.data.message.id;
                    this.editContactName= res.data.message.name;
                    this.editContactEmail= res.data.message.email;

                    this.editAddressId= res.data.message.address.id;
                    this.editContactPublic_place= res.data.message.address.public_place;
                    this.editContactNeighborhood= res.data.message.address.neighborhood;
                    this.editContactNumber= res.data.message.address.number;
                    this.editContactCity= res.data.message.address.city;
                    this.editContactState= res.data.message.address.state;


                    // console.log(res.data.message);
                  } 
              } catch (err) {
                  console.log(err);
              }
          },
          async updateContact(contactId, addressId) {
            console.log(contactId, 'contactIdaaa', addressId);

            if (contactId !== '' && this.editContactName !== '' && this.editContactEmail !== '') {
                const data = {
                  user_id: contactId,
                  name: this.editContactName,
                  email: this.editContactEmail
                };

                try {
                  const res = await axios.put(`/contact/web/contact/update/${contactId}`, data);

                  if (res.data.success) {
                    if (res.data.message.id) {

                      console.log(res.data.message.id);

                      this.updateAddress(contactId, addressId)
                        .then(result => {
                          if (result) {
                            console.log("The address was edit successfully");
                          } else {
                            console.log("Unable to edit address");
                          }

                        })
                        .catch(error => {
                          console.log("Erro ao executar a promise:", error);
                        });
                    }

                    alert('Contact edit successfully');
                  }
                } catch (err) {

                  alert(err);
                }
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
                  // console.log(res.data.data);
                }                
              })
              .catch(err => {
                console.log(err);
              });
          },
          async getUserContacts(userId) {
              try {
                  const res = await axios.get(`/contact/web/users/${userId}`); 

                  if (res.data.success) {
                    this.userIdReloadTable = res.data.message.id;
                    this.userNameTitle = res.data.message.name;
                    this.contactList = res.data.message.contacts;
                  } 
              } catch (err) {
                  console.log(err.data.message);
              }
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
          async updateAddress(contactId, addressId) {
            if (this.editContactPublic_place !== '' &&
                this.editContactNeighborhood !== '' &&
                this.editContactNumber !== '' &&
                this.editContactCity !== '' &&
                this.editContactState
              ) { 

              const data = {
                contact_id: contactId,
                number: this.editContactNumber,
                public_place: this.editContactPublic_place,
                neighborhood: this.editContactNeighborhood,
                city: this.editContactCity,
                state: this.editContactState
              };

              try {
                  const res = await axios.put(`/contact/web/address/update/${addressId}`, data);

                  if (res.data.success) {
                    console.log('Adrress edit successfully');

                    return true;
                  }
              } catch (err) {
                console.log(err);

                return false;
              }
            }
          },
          async deleteContact(contactId, userIdReloadTable) {

            if (window.confirm('Delete this contact')) {
              try {
                  const res = await axios.delete(`/contact/web/contact/${contactId}/delete`); 

                  if (res.data.success) {
                    // console.log(res.data.message);
                    this.getUserContacts(userIdReloadTable);
                    alert(res.data.message);
                  } 
              } catch (err) {
                  // console.log(err.response.data.message);
                  alert(err.response.data.message);
              }
            }
          },
          async createPhones(getContactId) {
            
            if (getContactId !== '' && this.number !== '') { 

              const data = {
                contact_id: getContactId,
                number: this.number
              };

              console.log(data);

              try {
                  const res = await axios.post('/contact/web/phones/create', data);
                  if (res.data.success) {
                    alert('Phone created successfully');
                    this.number = '';
                  }

              } catch (err) {
                console.log(err.response.data.message);
                alert(err.response.data.message);

              }
            }
          },
          async getContactPhones(contactId) {
              try {
                  const res = await axios.get(`/contact/web/contact/${contactId}`); 

                  if (res.data.success) {
                    this.contactNameTitle = res.data.message.name;
                    this.contactIdReloadTable = res.data.message.id;
                    this.phoneList = res.data.message.phones;
                  } 

              } catch (err) {
                  console.log(err);

              }
          },
          async deletePhone(phoneId, contactIdReloadTable) {

            if (window.confirm('Delete this phone')) {
              try {
                  const res = await axios.delete(`/contact/web/phones/${phoneId}/delete`); 

                  if (res.data.success) {
                    // console.log(res.data.message);
                    this.getContactPhones(contactIdReloadTable);
                    alert(res.data.message);
                  } 
              } catch (err) {
                  // console.log(err.response.data.message);
                  alert(err.response.data.message);
              }
            }
          },
        },
        watch: {
          selectedUser(newVal) {
          }
        },
        mounted() {
          this.getUsers();
        }
      }).mount('#app');
    </script>
  </body>
</html>
