/** @format */

import Vue from 'vue'

import VueRouter from 'vue-router'

import HomePage from './components/Dashboard.vue'

import HomePage1 from './components/Dashboard1.vue'

import HomePage2 from './components/Dashboard2.vue'

import HomePage3 from './components/Dashboard3.vue'

import UploadDataFiles from './components/UploadDataFiles.vue'

import UploadImages from './components/UploadImages.vue'

import ItemViewMasterfiles from './components/ItemMasterfile.vue' //for admin view

import ItemViewMasterfiles1 from './components/ItemMasterfile1.vue' //for supervisor view

import Transaction from './components/Transaction.vue' //Transaction

import CustomerMasterfile from './components/CustomerMasterfileComponent.vue'

import TeleOrdering from './components/TeleOrdering.vue'

import ReportFiles from './components/ReportFile.vue'

import ExportDataFiles from './components/ExportMasterfile.vue'

import ExportArisFiles from './components/ExportArisFile.vue'

import PromoFiles from './components/PromoFile.vue'

import GroupCode from './components/AccountGroupCodes.vue'

import UsertypeComponent from './components/UsertypeComponent.vue'

import AddCustomer from './components/AddCustomerSetup.vue'

import EditCustomer from './components/EditCustomerSetup.vue'

import SalesmanList from './components/Salesman&Jefe.vue'

import NewCustomer from './components/newCustomerRequest.vue'

import SalesmanRoute from './components/SalesmanRoutes.vue'

import ImportCustomer from './components/ImportCustomer.vue'

import ImportItemBulk from './components/ImportItemBulk.vue'

import HepeDeViaje from './components/HepedeViajeComponent.vue'

import Supplier from './components/PrincipalComponent.vue'

import AboutUs from './components/AboutUs.vue'

import Profile from './components/Profile.vue'

import ItemsDiscount from './components/ItemDiscount.vue'

import SalesReport from './components/SalesReport.vue'

import ViewingUser from './components/ViewingUser.vue'

import SetupUser from './components/SetupUser.vue'

import TopReports from './components/TopReports.vue'

import OrderHistory from './components/OrderHistory.vue' 

import Chat from './components/Chat.vue'

import OrderCutOffTime from './components/OrderCutOffTime.vue'

import CustomerFeedBack from './components/FeedBack.vue'

// miscellaneous utilities
// kaloy 2021-11-10
import MiscUtils from './components/MiscUtils.vue'

Vue.use(VueRouter)

const router = new VueRouter({
  mode: 'history',
  routes: [
    {
      path: '/dashboard',
      component: HomePage,
      meta: {
        name: 'Home'
      }
    },
    {
      path: '/dashboard1',
      component: HomePage1,
      meta: {
        name: 'Home'
      }
    },
    {
      path: '/dashboard2',
      component: HomePage2,
      meta: {
        name: 'Home'
      }
    },
    {
      path: '/dashboard3',
      component: HomePage3,
      meta: {
        name: 'Home'
      }
    },
    {
      path: '/upload',
      component: UploadDataFiles,
      meta: {
        name: 'Consolidate Data'
      }
    },
    {
      path: '/export',
      component: ExportDataFiles,
      meta: {
        name: 'Export Data'
      }
    },
    {
      path: '/export_aris',
      component: ExportArisFiles,
      meta: {
        name: 'Export Aris File'
      }
    },
    {
      path: '/setup_user',
      component: SetupUser,
      meta: {
        name: 'Setup User Account'
      }
    },
    {
      path: '/upload_image',
      component: UploadImages,
      meta: {
        name: 'Item Masterfile'
      }
    },
    {
      path: '/promo',
      component: PromoFiles,
      meta: {
        name: 'Promo'
      }
    },
    {
      path: '/report',
      component: ReportFiles,
      meta: {
        name: 'Reports'
      }
    },
    {
      path: '/item',
      component: ItemViewMasterfiles,
      meta: {
        name: 'Item Masterfile'
      }
    },
    {
      path: '/tele_ordering',
      component: TeleOrdering,
      children: [
        {
          path: ':contactData',
          name: 'contactChat',
          component: Chat,
          props: true
        }
      ],
      meta: {
        name: 'Tele-Ordering'
      }
    },
    {
      path: '/transactions',
      component: Transaction,
      meta: {
        name: 'Transactions'
      }
    },
    {
      path: '/item1',
      component: ItemViewMasterfiles1,
      meta: {
        name: 'Item Masterfile'
      }
    },
    {
      path: '/customer_masterfile',
      component: CustomerMasterfile,
      meta: {
        name: 'Customer Masterfile'
      }
    },
    {
      path: '/account_group_code',
      component: GroupCode,
      meta: {
        name: 'Account Group Code'
      }
    },
    {
      path: '/usertype',
      component: UsertypeComponent
    },
    {
      path: '/add_customer',
      component: AddCustomer,
      meta: {
        name: 'Add Customer'
      }
    },
    {
      path: '/edit_customer/:customer_id',
      component: EditCustomer,
      props: true,
      meta: {
        name: 'Edit Customer'
      }
    },
    {
      path: '/customer_request',
      component: NewCustomer,
      meta: {
        name: 'New Requests'
      }
    },
    {
      path: '/salesman',
      component: SalesmanList,
      meta: {
        name: 'Salesman & Jefe de Viaje'
      }
    },
    {
      path: '/salesreport',
      component: TopReports,
      meta: {
        name: 'Sales Report'
      }
    },
    {
      path: '/salesman_routes',
      component: SalesmanRoute,
      meta: {
        name: 'Salesman Route'
      }
    },
    {
      path: '/import_customer',
      component: ImportCustomer,
      meta: {
        name: 'Import Customer'
      }
    },
    {
      path: '/import_item_bulk',
      component: ImportItemBulk,
      meta: {
        name: 'Import Item Bulk'
      }
    },
    {
      path: '/hepe_de_viaje',
      component: HepeDeViaje,
      meta: {
        name: 'Jepe de Viaje'
      }
    },
    {
      path: '/suppliers',
      component: Supplier,
      meta: {
        name: 'Suppliers'
      }
    },
    {
      path: '/about',
      component: AboutUs,
      meta: {
        name: 'About Us'
      }
    },
    {
      path: '/profile',
      component: Profile,
      meta: {
        name: 'Profile'
      }
    },
    {
      path: '/item_discount',
      component: ItemsDiscount,
      meta: {
        name: 'Item Discount'
      }
    },
    {
      path: '/sales_report',
      component: SalesReport,
      meta: {
        name: 'Sales Report'
      }
    },
    {
      path: '/order_history',
      component: OrderHistory,
      meta: {
        name: 'Order History'
      }
    },
    {
      path: '/viewing_user',
      component: ViewingUser,
      meta: {
        name: 'Viewing User'
      }
    },
    
    {
      path: '/customer_feedbacks',
      component: CustomerFeedBack,
      meta: {
        name: 'Customer Feedbacks'
      }
    },
    {
      path: '/order-cut-off-time',
      component: OrderCutOffTime,
      meta: {
        name: 'Order Cut-off Time'
      }
    },
    
    // Miscellaneous utilities
    // kaloy 2021-11-10
    {
      path: '/misc-utils',
      component: MiscUtils,
      meta: {
        name: 'MiscUtils'
      }
    }
  ]
})
export default router
