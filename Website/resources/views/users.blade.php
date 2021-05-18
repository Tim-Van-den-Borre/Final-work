<x-app-layout>
    <x-slot name="header">
        <h3>{{ __('Users') }}</h3>
    </x-slot>

    @if (session('userRemoved'))
        <div id="usersToast" class="position-fixed bottom-0 right-0 p-3">
            <div id="usersLiveToast" class="toast hide" role="alert" aria-live="assertive" aria-atomic="true" data-delay="5000">
                <div class="toast-header">
                <strong class="mr-auto">Appointment Manager</strong>
                <small>Just now</small>
                <button type="button" class="ml-2 mb-1 close" data-dismiss="toast" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                </div>
                <div class="toast-body">
                        User <b>{{ session('userRemoved') }}</b> has been removed successfully.
                </div>
            </div>
        </div>
    @endif
    
    @if (session('privilegealert'))
        <div id="usersToast" class="position-fixed bottom-0 right-0 p-3">
            <div id="usersLiveToast" class="toast hide" role="alert" aria-live="assertive" aria-atomic="true" data-delay="5000">
                <div class="toast-header">
                <strong class="mr-auto">Appointment Manager</strong>
                <small>Just now</small>
                <button type="button" class="ml-2 mb-1 close" data-dismiss="toast" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                </div>
                <div class="toast-body">
                        Role for <b>{{ session('privilegealert') }}</b> has been updated successfully.
                </div>
            </div>
        </div>
    @endif

    @if (session('userCreated'))
    <div id="usersToast" class="position-fixed bottom-0 right-0 p-3">
        <div id="usersLiveToast" class="toast hide" role="alert" aria-live="assertive" aria-atomic="true" data-delay="5000">
            <div class="toast-header">
            <strong class="mr-auto">Appointment Manager</strong>
            <small>Just now</small>
            <button type="button" class="ml-2 mb-1 close" data-dismiss="toast" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
            </div>
            <div class="toast-body">
                    User <b>{{ session('userCreated') }}</b> has been created successfully.
            </div>  
        </div>
    </div>
    @endif

    <div class="py-12">
        <div class="max-w-10xl mx-auto sm:px-8 lg:px-8">
            <div class="row">
                <x-jet-validation-errors class="mb-4" />
            </div>
            <div class="row">
                <div class="col-3">
                    <input class="form-control" id="myInput" type="text" placeholder="Search...">
                </div>
                <div class="col-7"></div>
                <div class="col-2">
                    <button type="button" class="btn btn-success btn-sm" data-toggle="modal" data-target="#staticBackdrop">
                        Add User
                      </button>

                      <div class="modal fade" id="staticBackdrop" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                        <div class="modal-dialog">
                          <div class="modal-content">
                            <div class="modal-header">
                              <h5 class="modal-title" id="staticBackdropLabel">Add User</h5>
                              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                              </button>
                            </div>
                            <div class="modal-body">
                                <x-jet-label style="border-bottom: solid #108fc2;"/>
                                
                                <form method="POST" action="{{ route('registerUser') }}">
                                    @csrf
                        
                                    <div class="mt-1">
                                        <x-jet-label for="name" value="{{ __('Name') }}" />
                                        <x-jet-input id="name" class="block mt-1 w-full" type="text" name="name" :value="old('name')" required autofocus autocomplete="name" />
                                    </div>
                        
                                    <div class="mt-4">
                                        <x-jet-label for="email" value="{{ __('Email') }}" />
                                        <x-jet-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required />
                                    </div>

                                    <div class="mt-4">
                                        <x-jet-label for="role" value="{{ __('Role') }}" />
                                        
                                        <select class="custom-select" id="role" name="role" required>
                                            <option value="">Choose...</option>
                                            <option value="Patient">Patient</option>
                                            <option value="Doctor">Doctor</option>
                                            <option value="Admin">Admin</option>
                                        </select>
                                    </div>
                        
                                    <div class="mt-4">
                                        <x-jet-label for="birthdate" value="{{ __('Birthdate') }}" />
                                        <x-jet-input id="birthdate" class="block mt-1 w-full" type="date" name="birthdate" :value="old('birthdate')" required />
                                        <script>
                                            let today = new Date();

                                            let month = today.getMonth() + 1;
                                            let day = today.getDate();
                                            let year = today.getFullYear() - 18;
                                            if (month < 10) {
                                                month = "0" + month.toString();
                                            }

                                            if (day < 10) {
                                                day = "0" + day.toString();
                                            }

                                            let inputDate = year + "-" + month + "-" + day;
                                            $("#birthdate").attr("max", inputDate);
                                        </script>
                                    </div>
                        
                                    <div class="mt-4">
                                        <x-jet-label for="phonenumber" value="{{ __('Phone (format: 0999 99 99 99)') }}" />
                                        <x-jet-input id="phonenumber" class="block mt-1 w-full" type="tel" name="phonenumber" pattern="[0-9]{4} [0-9]{2} [0-9]{2} [0-9]{2}" :value="old('phonenumber')" required />
                                    </div>
                        
                                    <div class="mt-4">
                                        <x-jet-label for="password" value="{{ __('Password') }}" />
                                        <x-jet-input id="password" class="block mt-1 w-full" type="password" name="password" required autocomplete="new-password" />
                                    </div>
                        
                                    <div class="mt-4">
                                        <x-jet-label for="password_confirmation" value="{{ __('Confirm Password') }}" />
                                        <x-jet-input id="password_confirmation" class="block mt-1 w-full" type="password" name="password_confirmation" required autocomplete="new-password" />
                                    </div>
                        
                                    <div class="flex items-center justify-end mt-4">                        
                                        <x-jet-button class="ml-4">
                                            {{ __('Add') }}
                                        </x-jet-button>
                                    </div>
                                    <br />
                                    <x-jet-label style="border-bottom: solid #108fc2;"/>
                                </form>
                            </div>
                          </div>
                        </div>
                    </div>
                </div>
            </div>
            
            <br />
            <table class="table" style="text-align: center;">
                <thead class="thead-dark">
                  <tr>
                    <th scope="col">Name</th>
                    <th scope="col">Email</th>
                    <th scope="col">Phone</th>
                    <th scope="col">Role</th>
                    <th scope="col">Edit role</th>
                    <th scope="col">Remove</th>
                  </tr>
                </thead>
                <tbody id="myTable">
                    @foreach($users as $user)
                    <tr>
                        <td>{{ $user->name }}</td>
                        <td>{{ $user->email}}</td>
                        <td>{{ $user->phonenumber}}</td>
                        <td>{{ $user->role}}</td>
                        <td>
                            @if ($user->id != Auth::id())
                            <form method="post" action="{{ route('setPrivilege') }}">
                                @csrf
                                    <input class="hidden" value="{{ $user->id }}" id="userID" name="userID" />
                                    
                                    
                                    <select class="custom-select" id="role" name="role" onchange="this.form.submit()" required>
                                        <option value="">Choose...</option>
                                        <option value="Patient">Patient</option>
                                        <option value="Doctor">Doctor</option>
                                        <option value="Admin">Admin</option>
                                    </select>
                            </form>
                            @endif
                        </td>
                        <td>
                            @if ($user->id != Auth::id())
                            <button type="button" class="btn btn-danger btn-sm" data-toggle="modal" data-target="#staticBackdropRemove{{ $user->id }}">X</button>                             
                            @endif                     
                            <div class="modal fade" id="staticBackdropRemove{{ $user->id }}" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabelRemove" aria-hidden="true">
                                <div class="modal-dialog modal-lg">
                                <div class="modal-content">
                                    <div class="modal-header">
                                    <h5 class="modal-title" id="staticBackdropLabelRemove">Remove {{ $user->name }}</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                    </div>
                                    <div class="modal-body">
                                        <p>Are you sure you want to remove {{ $user->name }}?</p>
                                        <br />
                                        <p style="color: red;">Removing this user will remove their appointments / medical histories!</p>
                                        
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary btn-sm" data-dismiss="modal">Cancel</button>

                                        <form action="{{ route('remove-user')}}" method="get">
                                            <input type="hidden" id="userID" name="userID" value="{{ $user->id }}">
                                            <input type="hidden" id="userRole" name="userRole" value="{{ $user->role }}">
                                            <button type="submit" class="btn btn-danger btn-sm">Remove</button>
                                        </form>
                                    </div>
                                </div>
                                </div>
                            </div>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
          
          <script>
          $(document).ready(function(){
            $("#myInput").on("keyup", function() {
              var value = $(this).val().toLowerCase();
              $("#myTable tr").filter(function() {
                $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
              });
            });
          });
          </script>
        </div>
    </div>
</x-app-layout>