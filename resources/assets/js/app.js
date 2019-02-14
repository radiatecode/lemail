
/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');

window.Vue = require('vue');

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

Vue.component('example-component', require('./components/ExampleComponent.vue'));

const app = new Vue({
    el: '#app',
    data: {
        new_messages:{},
        notification:{}
    },
    created(){
        this.getData();
        this.listen();
        //this.tableRowInsert();
    },
    methods:{
        getData(){
            axios.get('/notifications')
                .then((response) => {
                    this.notification = response.data
                    //console.log(JSON.parse(response.data[0].data).users.name)
                })
                .catch((error) =>
                    console.log('something went wrong in notification method')
                );
        },
        listen(){
            let user_id = document.querySelector("meta[name='user-id']").getAttribute("content");
            Echo.private('user.'+user_id)
                .listen('NewMessage', (e) => {
                    this.new_messages = e;
                    this.notification.unshift({
                            message_id:e.message_id,
                            subject:e.subject,
                            sent_by:e.sent_by,
                            created_at:e.created_at
                    });
                    document.getElementById("count").innerHTML = this.notification.length;
                    //console.log(e);r
                    this.tableRowInsert();

                });
        },
        viewMessage(id){
            window.location.href = "/read/message/"+id;
        },
        tableRowInsert(){
            let table = document.getElementById("sent_table").getElementsByTagName("tbody")[0];
            let row = table.insertRow(0);

            let cell1 = row.insertCell(0);
            let cell2 = row.insertCell(1);
            let cell3 = row.insertCell(2);
            let cell4 = row.insertCell(3);
            let cell5 = row.insertCell(4);

            cell1.innerHTML = "<td>" +
                "<input class='form-check-input' type='checkbox' name='ids[]'" +
                "value='"+this.new_messages.receiver_pid+"'>" +
                "</td>" ;
            cell2.innerHTML="<td><b>"+this.new_messages.subject+"</b></td>";
            cell3.innerHTML="<td><b>"+this.new_messages.message+"</b></td>";
            cell4.innerHTML="<td><b>"+this.new_messages.created_at+"</b></td>";
            cell5.innerHTML="<td>" +
                "<a href='/read/message/"+this.new_messages.message_id+"' class='btn btn-xs social-btn btn-social-outline-twitter'>" +
                "<i class='mdi mdi-eye'></i></a>"+
            "</td>";
        }
    }
});
