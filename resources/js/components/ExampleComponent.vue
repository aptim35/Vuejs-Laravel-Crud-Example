<template>
    <div>
        <div class="container">
            <div align="right">
                <br>
                <button type="button" id="add_button" data-toggle="modal" data-target="#Modal_Add" class="btn btn-info
           btn-sm">Add new record</button>
            </div> <br>
            <table class="table">
                <thead>
                    <tr>
                        <th scope="col">ID</th>
                        <th scope="col">BOOK NAME</th>
                        <th scope="col">BOOK CODE</th>
                        <th scope="col">AUTHOR</th>
                        <th scope="col">#</th>
                    </tr>
                </thead>
                <tbody>
                    <tr v-for="book in books" :key="book.id">
                        <th scope="row">{{ book.id }}</th>
                        <td>{{ book.name }}</td>
                        <td>{{ book.book_code }}</td>
                        <td>{{ book.author }}</td>
                        <td>
                            <button type="button" data-toggle="modal" data-target="#Modal_Edit"
                                @click="getBookEdit(book.id)" class="btn btn-success btn-sm">Edit</button>
                            <button type="button" @click="deleteBook(book.id)"
                                class="btn btn-danger btn-sm">Delete</button>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
        <!-- Modal -->
        <div class="modal fade" id="Modal_Add" role="dialog">
            <div class="modal-dialog">

                <!-- Modal content-->
                <div class="modal-content">
                    <div class="modal-header">

                        <h4 class="modal-title">Add new book</h4>

                    </div>
                    <form @submit.prevent="addBook">
                        <div class="modal-body">
                            <div class="form-group row">

                                <div class="col-md-9">
                                    <label for="">Book Name</label>
                                    <input type="text" v-model="newBook.name" name="name" id="name" class="form-control"
                                        required>

                                </div>
                                <div class="col-md-9">
                                    <label for="">Book Code</label>
                                    <input type="text" v-model="newBook.book_code" name="book_code" id="book_code"
                                        class="form-control" required>

                                </div>
                                <div class="col-md-9">
                                    <label for="">Author</label>
                                    <input type="text" v-model="newBook.author" name="author" id="author"
                                        class="form-control" required>

                                </div>



                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                            <button type="button" @click="addBook" class="btn btn-primary">Save</button>
                        </div>
                    </form>
                </div>

            </div>
        </div>

        <!-- Modal Edit -->
        <div class="modal fade" id="Modal_Edit" role="dialog">
            <div class="modal-dialog">

                <!-- Modal content-->
                <div class="modal-content">
                    <div class="modal-header">

                        <h4 class="modal-title">Edit book</h4>

                    </div>
                    <form @submit.prevent="postBookEdit">
                        <div class="modal-body">
                            <div class="form-group row">

                                <div class="col-md-9">
                                    <label for="">Book Name</label>
                                    <input type="text" v-model="editBook.name"  name="name" id="name" class="form-control"
                                        required>

                                </div>
                                <div class="col-md-9">
                                    <label for="">Book Code</label>
                                    <input type="text" v-model="editBook.book_code" name="book_code" id="book_code"
                                        class="form-control" required>

                                </div>
                                <div class="col-md-9">
                                    <label for="">Author</label>
                                    <input type="text" v-model="editBook.author" name="author" id="author"
                                        class="form-control" required>

                                </div>



                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                            <button type="button" @click="postBookEdit" class="btn btn-primary">Update</button>
                        </div>
                    </form>
                </div>

            </div>
        </div>




    </div>
</template>
<script>
export default {

    data() {
        return {
            books: [],
            newBook: {
                name: '',
                book_code: '',
                author: ''
            },
            editBook: {
                id:'',
                name: '',
                book_code: '',
                author: ''
            },
        }
    },

    created() {
        this.showAll();
    },

    methods: {
        showAll() {
            axios.get("http://localhost:8000/data").then((res) =>
                this.books = res.data.books);
        },

        async addBook() {
            axios.post('http://localhost:8000/book', this.newBook).then(response => {
                window.location.reload();

            }).catch(error => {
                console.log(error)
            })
        },

        async getBookEdit(id) {
            await axios.get('http://localhost:8000/book/edit/' + id).then(response => {

                this.editBook.id = response.data.firstbook.id
                this.editBook.name = response.data.firstbook.name
                this.editBook.book_code = response.data.firstbook.book_code
                this.editBook.author = response.data.firstbook.author


            }).catch(error => {
                console.log(error)
            })
        },

        async postBookEdit(){
            await axios.post('http://localhost:8000/book/edit',this.editBook).then(response=>{
                window.location.reload(); 
            }).catch(error=>{
                console.log(error)
            })
        },


        deleteBook(id) {
            if (confirm("Are you sure to delete this book ?")) {
                axios.delete('http://localhost:8000/book/delete/' + id).then(response => {

                    window.location.reload();
                }).catch(error => {
                    console.log(error)
                })
            }
        }


    }
}
</script>

