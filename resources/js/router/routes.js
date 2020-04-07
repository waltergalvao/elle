import Batches from "../pages/Batches";
import BatchDetails from "../pages/BatchDetails";
import Contacts from "../pages/Contacts";

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
]
