<div class="modal fade in" id="details_page" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
     aria-hidden="true">
    <div class="modal-dialog  modal-lg" role="document">
        <div class="modal-content">
                <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">{{__('lang.news_details')}}</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                    <div class="modal-body">
                        <table class="table table-bordered details-table"  style="font-size:10pt;">
                            <tr>
                                <th>{{__('lang.title')}}</th>
                                <td class="title"></td>
                                <th>{{__('lang.category')}}</th>
                                <td class="category"></td>
                                
                            </tr>
                            <tr>
                                <th>{{__('lang.client_name')}}</th>
                                <td class="client_name"></td>
                                <th>{{__('lang.price')}}</th>
                                <td class="price"></td>
                            </tr>
                            <tr>
                                <th>{{__('lang.city')}}</th>
                                <td class="language"></td>
                                <th>{{__('lang.status')}}</th>
                                <td class="status"></td>
                            </tr>
                           
                            <tr>
                                <th>{{__('lang.main_image')}}</th>
                                <td colspan="3"  class="main_image"></td>
                            </tr>
                        </table>
                        <table class="table table-bordered">
                            <tr>
                                <td colspan="2"><b>{{__('lang.details')}}</b></td>
                            </tr>
                            <tr>
                                <td colspan="2" class="details">
                                </td>
                            </tr>
                        </table>
                        <table class="table table-bordered">
                            <tr>
                                <td colspan="2"><b>{{__('lang.additional_images')}}</b></td>
                            </tr>
                            <tr>
                                <td colspan="2" class="pictures" style="padding:15px">

                                </td>
                            </tr>
                            
                        </table>
                        <table class="table table-bordered">
                            <tr>
                                <td colspan="2"><b>{{__('lang.certificated_products')}}</b></td>
                            </tr>
                            <tr>
                                <td colspan="2" class="certified_pictures" style="padding:15px">

                                </td>
                            </tr>
                            
                        </table>
                        
                    </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">{{__('lang.cancel')}}</button>
                </div>
                <div id="loading">
                    <img id="loading-image" src="/admin/assets/ajax-loader.gif" alt="Loading..."/>
                </div>
        </div>
    </div>
</div>