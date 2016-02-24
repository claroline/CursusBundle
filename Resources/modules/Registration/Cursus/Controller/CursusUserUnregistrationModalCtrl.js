/*
 * This file is part of the Claroline Connect package.
 *
 * (c) Claroline Consortium <consortium@claroline.net>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
    
export default class CursusUserUnregistrationModalCtrl {
        
    constructor($http, $uibModalInstance, cursusUserId, name, callBack) {
        this.$http = $http
        this.$uibModalInstance = $uibModalInstance
        this.cursusUserId = cursusUserId
        this.name = name
        this.callBack = callBack
    }
    
    closeModal() {
        this.$uibModalInstance.close()
    }

    confirmModal() {
        const route = Routing.generate('api_delete_cursus_user', {cursusUser: this.cursusUserId})
        this.$http.delete(route).then(datas => {

            if (datas['status'] === 200) {
                this.callBack(this.cursusUserId)
                this.closeModal()
            }
        })
    }
}