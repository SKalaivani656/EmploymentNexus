var app = new Vue({
    el: '#notificationlink',
    data: {
        isProcessing: false,
        form: {},
        errors: {},
    },
    created: function () {
        Vue.set(this.$data, 'form', _form);
    },
    methods: {
        addLine: function () {
            this.form.notificationrecord.push({
                notification_name: '',
                notification_source: 'Click Here',
                notification_link: ''
            });
        },
        remove: function (notificationrow) {
            let index = this.form.notificationrecord.indexOf(notificationrow)
            this.form.notificationrecord.splice(index, 1);
        },
    },
})