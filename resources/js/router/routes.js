import Batches from "../pages/Batches";
import BatchDetails from "../pages/BatchDetails";
import Contacts from "../pages/Contacts";
import Companies from "../pages/Companies";
import EditContact from "../pages/EditContact";
import EditCompany from "../pages/EditCompany";
import AddCompany from "../pages/AddCompany";

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
        path: '/contacts/:id',
        name: 'contacts.edit',
        component: EditContact,
    },
    {
        path: '/companies',
        name: 'companies',
        component: Companies,
    },
    {
        path: '/companies/add',
        name: 'companies.add',
        component: AddCompany,
    },
    {
        path: '/companies/:id',
        name: 'companies.edit',
        component: EditCompany,
    },
]
