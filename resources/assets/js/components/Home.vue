<template>
    <div id="home" v-if="todayDate">
        <b-form @submit="onSubmit">
            <b-form-group
                    id="input-group-1"
                    label="Email address:"
                    label-for="input-1"
                    description="Send to multi receiver with ',' seperator eg: papa@gmail.com,mama@gmail.com"
            >
                <b-form-input
                        id="input-1"
                        v-model="form.recipients"
                        required
                        placeholder="Enter email"
                ></b-form-input>
            </b-form-group>

            <b-form-group id="input-group-2" label="Title:" label-for="input-2">
                <b-form-input
                        id="input-2"
                        v-model="form.title"
                        required
                        placeholder="Enter Title"
                ></b-form-input>
            </b-form-group>

            <b-form-group id="input-group-3" label="Content:" label-for="input-3">
                <b-form-textarea
                        id="input-3"
                        v-model="form.content"
                        placeholder="Enter Content"
                        rows="8"
                        max-rows="20"
                ></b-form-textarea>
            </b-form-group>
            <b-form-group id="input-group-4" label="Date:" label-for="input-4">
                <b-form-datepicker
                        id="input-4"
                        v-model="form.send_date"
                        locale="en"
                        :min="todayDate"
                        class="mb-2"></b-form-datepicker>
            </b-form-group>
            <b-form-group id="input-group-5" label="Time:" label-for="input-5">
                <b-time v-model="form.send_time" locale="en"></b-time>

            </b-form-group>
            <b-button type="submit" variant="primary">Submit</b-button>
        </b-form>
    </div>
</template>

<script>

    export default {
        name: "Home",
        data() {
            return {
                form: {
                    recipients: '',
                    title: '',
                    content: '',
                    send_date: '',
                    send_time: ''
                },
            }
        },
        computed: {
            todayDate: function () {
                const now = new Date()
                const today = Date(now.getFullYear(), now.getMonth(), now.getDate())
                return new Date(today)
            },
            sendDateTime: function () {
                return this.form.send_date + " " + this.form.send_time
            }
        },
        methods: {
            onSubmit(event) {
                event.preventDefault()
                fetch("/create-task", {
                    method: "post",
                    headers: {
                        'Accept': 'application/json',
                        'Content-Type': 'application/json',
                        "X-CSRF-Token": document.head.querySelector("[name~=csrf-token][content]").content
                    },
                    body: JSON.stringify({
                        'recipients': this.form.recipients,
                        'title': this.form.title,
                        'content': this.form.content,
                        'send_date': this.sendDateTime
                    })
                })
                    .then((resp) => resp.json()) // Transform the data into json
                    .then(function(data) {
                        if(data.status === 0){
                            alert('Add schedule email successful')
                        }
                    })
            }
        }
    }
</script>

<style scoped>
    #home {
        padding: 15px 0;
    }
</style>