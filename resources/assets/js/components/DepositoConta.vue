<template>
    <div>
        <h3 class="text-center">Fazer Depósito</h3>
        <div class="row">
            <div class="col-md-6">
                <div>
                    <table class="table table-bordered">
                        <tr>
                            <td>Cliente:</td>
                            <td>{{ conta[0].nome }}</td>
                        </tr>
                        <tr>
                            <td>Endereço:</td>
                            <td>{{ conta[0].endereco }}</td>
                        </tr>
                        <tr>
                            <td>Nº da conta:</td>
                            <td>{{ conta[0].conta }}</td>
                        </tr>
                        <tr>
                            <td>Saldo:</td>
                            <td>{{ conta[0].saldo }}</td>
                        </tr>
                    </table>
                </div>
                <form @submit.prevent="updateConta">
                    <div class="form-group">
                        <label>Valor</label>
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
                conta: {}
            }
        },
        created() {
            this.axios
                .get(`http://localhost:8080/api/contas/${this.$route.params.id}`)
                .then(response => {
                    this.conta = response.data.data;
                });
        },
        methods: {
            updateConta() {
                this.axios
                    .put(`http://localhost:8080/api/deposito/${this.$route.params.id}`, this.conta)
                    .then((response) => {
                        this.$router.push({name: 'home'});
                        console.log(response);
                    });
            }
        }
    }
</script>
