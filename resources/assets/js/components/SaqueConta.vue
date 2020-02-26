<template>
    <div>
        <h3 class="text-center">Fazer Saque</h3>
        <div class="row">
            <div class="col-md-6">
                <div v-if="!loading">
                    <table class="table table-bordered">
                        <tr>
                            <td>Cliente:</td>
                            <td>{{ conta.data[0].nome }}</td>
                        </tr>
                        <tr>
                            <td>Endereço:</td>
                            <td>{{ conta.data[0].endereco }}</td>
                        </tr>
                        <tr>
                            <td>Nº da conta:</td>
                            <td>{{ conta.data[0].conta }}</td>
                        </tr>
                        <tr>
                            <td>Saldo:</td>
                            <td>{{ conta.data[0].saldo | currency }}</td>
                        </tr>
                    </table>
                </div>
                <p v-if="errors.length">
                    <ul>
                        <li v-for="error in errors" :key="error">{{ error }}</li>
                    </ul>
                </p>
                <form @submit.prevent="updateConta">
                    <div class="form-group">
                        <label>Valor do saque</label>
                        <input type="text" class="form-control" v-model="conta.valor">
                    </div>
                    <button type="submit" class="btn btn-primary">Enviar</button>
                </form>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        data() {
            return {
                conta: {},
                loading: false,
                errors:[]
            }
        },
        created() {
            this.loading = true;
            this.axios
                .get(`http://localhost:8080/api/contas/${this.$route.params.id}`)
                .then(response => {
                    this.conta = response.data;
                    this.loading = false;
                });
        },
        methods: {
            updateConta() {
                this.axios
                    .put(`http://localhost:8080/api/saque/${this.$route.params.id}`, this.conta)
                    .then((response) => {
                        this.$router.push({name: 'home'});
                    })
                    .catch(error => {
                        this.errors = [];
                        if (error.response.status == 404){
                            this.errors.push("Preencha o valor!");
                        }
                    });
            }
        }
    }
</script>
