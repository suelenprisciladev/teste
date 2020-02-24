<template>
    <div>
        <h3 class="text-center">Contas</h3><br/>

        <table class="table table-bordered">
            <thead class="thead-light">
            <tr>
                <th class="coluna">Conta</th>
                <th class="coluna">Saldo</th>
                <th class="coluna">Ações</th>
            </tr>
            </thead>
            <tbody>
            <tr v-for="conta in contas" :key="conta.id">
                <td>{{ conta.conta }}</td>
                <td>{{ conta.saldo }}</td>
                <td>
                    <div class="btn-group" role="group">
                        <router-link :to="{name:'deposito', params: { id:conta.id }}" class="btn btn-primary">Depósito</router-link>&nbsp;
                        <router-link :to="{name:'saque', params: { id:conta.id }}" class="btn btn-primary">Saque</router-link>
                    </div>
                </td>
            </tr>
            </tbody>
        </table>
    </div>
</template>

<script>
    export default {
        data() {
            return {
                contas: []
            }
        },
        created() {
            this.axios
                .get('http://localhost:8080/api/contas')
                .then(response => {
                    this.contas = response.data.data;
                });
        }
    }
</script>
