import Contas from './components/Contas.vue';
import DepositoConta from './components/DepositoConta.vue';
import SaqueConta from './components/SaqueConta.vue';

export const routes = [
    {
        name: 'home',
        path: '/',
        component: Contas
    },
    {
        name: 'deposito',
        path: '/deposito/:id',
        component: DepositoConta
    },
    {
        name: 'saque',
        path: '/saque/:id',
        component: SaqueConta
    }
];
