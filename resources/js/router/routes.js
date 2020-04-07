import Batches from "../pages/Batches";
import BatchDetails from "../pages/BatchDetails";
import Contacts from "../pages/Contacts";
import Companies from "../pages/Companies";

export default [
    {
        path: '/',
        name: 'batches',
        component: Batches,
    },
    {
        path: '/batch/:id',
        name: 'batch.details',
        component: BatchDetails,
    },
    {
        path: '/contacts',
        name: 'contacts',
        component: Contacts,
    },
    {
        path: '/companies',
        name: 'companies',
        component: Companies,
    },
]
