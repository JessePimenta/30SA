<?php defined('SYSPATH') or die('No direct script access.');?>

<?if ($widget->text_title!=''):?>
    <div class="panel-heading">
        <h3 class="panel-title"><?=$widget->text_title?></h3>
    </div>
<?endif?>

<div class="panel-body">
    <?= FORM::open(Route::url('search'), array('class'=>'form-horizontal', 'method'=>'GET', 'action'=>'','enctype'=>'multipart/form-data'))?>
        <!-- if categories on show selector of categories -->
        <div class="form-group">
            <div class="col-xs-12">  
                <?= FORM::label('advertisement', __('Part Name/Car'), array('class'=>'', 'for'=>'title'))?>
                <input type="text" id="title" name="title" class="form-control" value="" placeholder="<?=__('Make/Model, Part Name...')?>">
            </div>
        </div>
        
        <?if($widget->advanced != FALSE):?>
            <?if($widget->cat_items !== NULL):?>
                <div class="form-group">
                    <div class="col-xs-12">
                        <?= FORM::label('category', __('Category'), array('class'=>'', 'for'=>'category_widget_search'))?>
                        <select <?=core::config('general.search_multi_catloc')? 'multiple':NULL?> name="category<?=core::config('general.search_multi_catloc')? '[]':NULL?>" id="category_widget_search" class="form-control" data-placeholder="<?=__('Selling/Parts Needed')?>">
                            <option></option>
                            <?function lili_search($item, $key, $params){?>
                                <?if (core::config('general.search_multi_catloc')):?>
                                    <option value="<?=$params['cats'][$key]['seoname']?>" data-id="<?=$params['cats'][$key]['id']?>" <?=(is_array($params['selected_category']) AND in_array($params['cats'][$key]['seoname'], $params['selected_category']))?"selected":''?> ><?=$params['cats'][$key]['name']?></option>
                                <?else:?>
                                    <option value="<?=$params['cats'][$key]['seoname']?>" data-id="<?=$params['cats'][$key]['id']?>" <?=($params['selected_category'] == $params['cats'][$key]['seoname'])?"selected":''?> ><?=$params['cats'][$key]['name']?></option>
                                <?endif?>
                                <?if (count($item)>0):?>
                                    <optgroup label="<?=$params['cats'][$key]['name']?>">  
                                        <? if (is_array($item)) array_walk($item, 'lili_search', array('cats' => $params['cats'], 'selected_category' => $params['selected_category']));?>
                                    </optgroup>
                                <?endif?>
                            <?}
                            $cat_order = $widget->cat_order_items; 
                            if (is_array($cat_order))
                                array_walk($cat_order , 'lili_search', array('cats' => $widget->cat_items, 'selected_category' => $widget->selected_category));?>
                        </select> 
                    </div>
                </div>
            <?endif?>
            <!-- end categories/ -->
            
            <!-- locations -->
            <?if($widget->loc_items !== NULL):?>
                <?if(count($widget->loc_items) > 1 AND core::config('advertisement.location') != FALSE):?>
                    <div class="form-group">
                        <div class="col-xs-12">
                            <?= FORM::label('location_widget_search', __('Where Are You?'), array('class'=>'', 'for'=>'location_widget_search' ))?>
                            <select <?=core::config('general.search_multi_catloc')? 'multiple':NULL?> name="location<?=core::config('general.search_multi_catloc')? '[]':NULL?>" id="location_widget_search" class="form-control" data-placeholder="<?=__('State, County, City, etc.')?>">
                                <option></option>
                                <?function lolo_search($item, $key, $params){?>
                                    <?if (core::config('general.search_multi_catloc')):?>
                                        <option value="<?=$params['locs'][$key]['seoname']?>" data-id="<?=$params['locs'][$key]['id']?>" <?=(is_array($params['selected_location']) AND in_array($params['locs'][$key]['seoname'], $params['selected_location']))?"selected":''?> ><?=$params['locs'][$key]['name']?></option>
                                    <?else:?>
                                        <option value="<?=$params['locs'][$key]['seoname']?>" data-id="<?=$params['locs'][$key]['id']?>" <?=($params['selected_location'] == $params['locs'][$key]['seoname'])?"selected":''?> ><?=$params['locs'][$key]['name']?></option>
                                    <?endif?>
                                    <?if (count($item)>0):?>
                                        <optgroup label="<?=$params['locs'][$key]['name']?>">  
                                            <? if (is_array($item)) array_walk($item, 'lolo_search', array('locs' => $params['locs'], 'selected_location' => $params['selected_location']));?>
                                        </optgroup>
                                    <?endif?>
                                <?}
                                $loc_order_search = $widget->loc_order_items; 
                                if (is_array($loc_order_search))
                                    array_walk($loc_order_search , 'lolo_search', array('locs' => $widget->loc_items, 'selected_location' => $widget->selected_location));?>
                            </select>
                        </div>
                    </div>
                <?endif?>
            <?endif?>
    
            <?if(core::config('advertisement.price')):?>
                <div class="form-group">
                    <div class="col-xs-12"> 
                        <label class="" for="price-min"><?=__('Minimum Price')?> </label>
                        <input type="text" id="price-min" name="price-min" class="form-control" value="<?=core::get('price-min')?>" placeholder="<?=__('Lowest')?>">
                    </div>
                </div>
            
                <div class="form-group">
                    <div class="col-xs-12">
                        <label class="" for="price-max"><?=__('Maximum Price')?></label>
                        <input type="text" id="price-max" name="price-max" class="form-control" value="<?=core::get('price-max')?>" placeholder="<?=__('Highest')?>">
                    </div>
                </div>
            <?endif?>
        <?endif?>
        <?if (Theme::get('premium')==1) :?>
            <!-- Fields coming from custom fields feature -->
            <div id="widget-custom-fields" data-apiurl="<?=Route::url('api', array('version'=>'v1', 'format'=>'json', 'controller'=>'categories'))?>" data-customfield-values='<?=json_encode(Request::current()->query())?>'>
                <div id="widget-custom-field-template" class="form-group hidden">
                    <div class="col-xs-12">
                        <div data-label></div>
                        <div data-input></div>
                    </div>
                </div>
            </div>
            <!-- Fields coming from user custom fields feature -->
            <?foreach(Model_UserField::get_all() as $name=>$field):?>
                <?if (isset($field['searchable']) AND $field['searchable']):?>
                    <div class="form-group">
                        <?$cf_name = 'cfuser_'.$name?>
                        <?if($field['type'] == 'select' OR $field['type'] == 'radio') {
                            $select = array('' => $field['label']);
                            foreach ($field['values'] as $select_name) {
                                $select[$select_name] = $select_name;
                            }
                        } else $select = $field['values']?>
                        <div class="col-xs-12">
                            <?= FORM::label('cfuser_'.$name, $field['label'], array('for'=>'cfuser_'.$name))?>
                            <?=Form::cf_form_field('cfuser_'.$name, array(
                            'display'   => $field['type'],
                            'label'     => $field['label'],
                            'tooltip'   => (isset($field['tooltip']))? $field['tooltip'] : "",
                            'default'   => $field['values'],
                            'options'   => (!is_array($field['values']))? $field['values'] : $select,
                            ),core::get('cfuser_'.$name), FALSE, TRUE)?> 
                        </div>
                    </div>
                <?endif?>
            <?endforeach?>
            <!-- /endcustom fields -->
        <?endif?>
        <div class="clearfix"></div>
    
        <?= FORM::button('submit', __('Search'), array('type'=>'submit', 'class'=>'btn btn-primary'))?> 
    <?= FORM::close()?>
</div>