<?php

namespace Aspro\Max\Smartseo\Admin\UI;

use Aspro\Max\Smartseo,
    Aspro\Max\Smartseo\Admin\Traits\BitrixCoreEntity,
    Aspro\Max\Smartseo\Models\SmartseoFilterRuleTable,
    Aspro\Max\Smartseo\Models\SmartseoFilterIblockSectionsTable,
    \Bitrix\Main\Localization\Loc;

Loc::loadMessages(__FILE__);

class FilterRulesAdminUI extends AbstractAdminUI
{

    private $siteItems = [];
    private $iblockTypeItems = [];
    private $iblockItems = [];
    private $iblockSectionItems = [];

    use BitrixCoreEntity;

    function __construct()
    {
        $rows = SmartseoFilterRuleTable::getList([
              'select' => ['IBLOCK_TYPE_ID', 'IBLOCK_ID', 'SITE_ID'],
              'group' => ['IBLOCK_TYPE_ID', 'IBLOCK_ID', 'SITE_ID'],
              'cache' => [
                  'ttl' => SmartseoFilterRuleTable::getCacheTtl(),
              ],
          ])->fetchAll();

        $iblockTypes = array_unique(array_column($rows, 'IBLOCK_TYPE_ID'));

        $iblockIds = array_unique(array_column($rows, 'IBLOCK_ID'));

        $siteIds = array_unique(array_column($rows, 'SITE_ID'));

        $this->iblockTypeItems = $this->getIblockTypeItems($iblockTypes);

        $this->iblockItems = $this->getIblockItems($iblockIds);

        if ($iblockIds && $this->iblockItems) {
            $this->iblockSectionItems = $this->getIblockSectionItems($iblockIds);
        }

        $this->siteItems = $this->getSiteItems($siteIds);
    }

    public function getGridId()
    {
        return 'grid_filter_rules';
    }

    public function getFilterFields()
    {
        $iblockSectionFields = [];

        foreach ($this->iblockItems as $iblockId => $iblockName) {
            $iblockSectionFields[] = [
                'id' => 'IBLOCK_' . $iblockId . '_SECTION_ID',
                'name' => Loc::getMessage('SMARTSEO_FRA_UI_FILTER_ENTITY_IBLOCK_SECTIONS', [
                    '#IBLOCK_NAME#' => $iblockName
                ]),
                'type' => 'list',
                'items' => $this->iblockSectionItems[$iblockId],
            ];
        }

        $filterFields = [
            [
                'id' => 'ID',
                'name' => Loc::getMessage('SMARTSEO_FRA_UI_ENTITY_ID'),
                'type' => 'number',
                'default' => true
            ],
            [
                'id' => 'ACTIVE',
                'name' => Loc::getMessage('SMARTSEO_FRA_UI_ENTITY_ACTIVE'),
                'type' => 'list',
                'default' => true,
                'items' => [
                    'Y' => Loc::getMessage('SMARTSEO_FRA_UI_VALUE_Y'),
                    'N' => Loc::getMessage('SMARTSEO_FRA_UI_VALUE_N'),
                ]
            ],
            [
                'id' => 'NAME',
                'name' => Loc::getMessage('SMARTSEO_FRA_UI_ENTITY_NAME'),
                'quickSearch' => '',
                'filterable' => '',
                'default' => true,
            ],
            [
                'id' => 'URL_CLOSE_INDEXING',
                'name' => Loc::getMessage('SMARTSEO_FRA_UI_ENTITY_URL_CLOSE_INDEXING'),
                'type' => 'list',
                "filterable" => '',
                'items' => [
                    'Y' => Loc::getMessage('SMARTSEO_FRA_UI_VALUE_Y'),
                    'N' => Loc::getMessage('SMARTSEO_FRA_UI_VALUE_N'),
                ]
            ],
            [
                'id' => 'SITE_ID',
                'name' => Loc::getMessage('SMARTSEO_FRA_UI_ENTITY_SITE_ID'),
                'type' => 'list',
                'items' => $this->siteItems,
            ],
            [
                'id' => 'IBLOCK_TYPE_ID',
                'name' => Loc::getMessage('SMARTSEO_FRA_UI_ENTITY_IBLOCK_TYPE'),
                'type' => 'list',
                'items' => $this->iblockTypeItems,
            ],
            [
                'id' => 'IBLOCK_ID',
                'name' => Loc::getMessage('SMARTSEO_FRA_UI_ENTITY_IBLOCK_ID'),
                'type' => 'list',
                'items' => $this->iblockItems,
            ],
        ];

        if ($iblockSectionFields) {
            foreach ($iblockSectionFields as $sectionField) {
                $filterFields[] = $sectionField;
            }
        }

        $filterFields = array_merge($filterFields, [
            [
                'id' => 'DATE_CREATE',
                'name' => Loc::getMessage('SMARTSEO_FRA_UI_ENTITY_DATE_CREATE'),
                'type' => 'date',
            ],
            [
                'id' => 'DATE_CHANGE',
                'name' => Loc::getMessage('SMARTSEO_FRA_UI_ENTITY_DATE_CHANGE'),
                'type' => 'date',
            ],
            [
                'id' => 'CREATED_BY',
                'name' => Loc::getMessage('SMARTSEO_FRA_UI_ENTITY_CREATED_BY'),
                'type' => 'custom_entity',
                'selector' => ['type' => 'user'],
            ],
            [
                'id' => 'MODIFIED_BY',
                'name' => Loc::getMessage('SMARTSEO_FRA_UI_ENTITY_MODIFIED_BY'),
                'type' => 'custom_entity',
                'selector' => ['type' => 'user'],
            ],
        ]);

        return $filterFields;
    }

    public function getContextMenu($urlParams = [])
    {
        return [
            [
                'TEXT' => Loc::getMessage('SMARTSEO_FRA_UI_MENU_ADD_ELEMENT'),
                'ICON' => '',
                'LINK' => '/bitrix/admin/' . Smartseo\General\Smartseo::MODULE_ID . '_smartseo.php?' . http_build_query(
                  array_merge(['route' => 'filter_rule_detail/detail'], $urlParams)
                )
            ],
            [
                'TEXT' => Loc::getMessage('SMARTSEO_FRA_UI_MENU_ADD_SECTION'),
                'ICON' => '',
                'LINK' => '/bitrix/admin/' . Smartseo\General\Smartseo::MODULE_ID . '_smartseo.php?' . http_build_query(
                  array_merge(['route' => 'filter_section/detail'], $urlParams)
                )
            ]
        ];
    }

    public function getGridColumns()
    {
        return [
            [
                'id' => 'NAME',
                'title' => Loc::getMessage('SMARTSEO_FRA_UI_ENTITY_NAME'),
                'content' => Loc::getMessage('SMARTSEO_FRA_UI_ENTITY_NAME'),
                'sort' => 'NAME',
                'width' => 400,
                'default' => true,
            ],
            [
                'id' => 'ACTIVE',
                'title' => Loc::getMessage('SMARTSEO_FRA_UI_ENTITY_ACTIVE'),
                'content' => Loc::getMessage('SMARTSEO_FRA_UI_ENTITY_ACTIVE'),
                'sort' => 'ACTIVE',
                'default' => true,
            ],
            [
                'id' => 'SITE_ID',
                'title' => Loc::getMessage('SMARTSEO_FRA_UI_ENTITY_SITE_ID'),
                'content' => Loc::getMessage('SMARTSEO_FRA_UI_ENTITY_SITE_ID'),
                'sort' => 'SITE_ID',
                'default' => false,
            ],
            [
                'id' => 'IBLOCK_TYPE_NAME',
                'title' => Loc::getMessage('SMARTSEO_FRA_UI_ENTITY_IBLOCK_TYPE'),
                'content' => Loc::getMessage('SMARTSEO_FRA_UI_ENTITY_IBLOCK_TYPE'),
                'sort' => 'IBLOCK_TYPE_ID',
                'default' => false,
            ],
            [
                'id' => 'IBLOCK_NAME',
                'title' => Loc::getMessage('SMARTSEO_FRA_UI_ENTITY_IBLOCK_ID'),
                'content' => Loc::getMessage('SMARTSEO_FRA_UI_ENTITY_IBLOCK_ID'),
                'sort' => 'IBLOCK_ID',
                'default' => false,
            ],
            [
                'id' => 'IBLOCK_SECTIONS',
                'title' => Loc::getMessage('SMARTSEO_FRA_UI_ENTITY_IBLOCK_SECTIONS'),
                'content' => Loc::getMessage('SMARTSEO_FRA_UI_ENTITY_IBLOCK_SECTIONS'),
                'sort' => '',
                'default' => true,
            ],
            [
                'id' => 'ID',
                'title' => Loc::getMessage('SMARTSEO_FRA_UI_ENTITY_ID'),
                'content' => Loc::getMessage('SMARTSEO_FRA_UI_ENTITY_ID'),
                'sort' => 'ID',
                'default' => true,
            ],
            [
                'id' => 'URL_CLOSE_INDEXING',
                'title' => Loc::getMessage('SMARTSEO_FRA_UI_ENTITY_URL_CLOSE_INDEXING'),
                'content' => Loc::getMessage('SMARTSEO_FRA_UI_ENTITY_URL_CLOSE_INDEXING'),
                'sort' => 'URL_CLOSE_INDEXING',
                'default' => false,
            ],
            [
                'id' => 'DATE_CREATE',
                'title' => Loc::getMessage('SMARTSEO_FRA_UI_ENTITY_DATE_CREATE'),
                'content' => Loc::getMessage('SMARTSEO_FRA_UI_ENTITY_DATE_CREATE'),
                'sort' => 'DATE_CREATE',
                'default' => false,
            ],
            [
                'id' => 'DATE_CHANGE',
                'title' => Loc::getMessage('SMARTSEO_FRA_UI_ENTITY_DATE_CHANGE'),
                'content' => Loc::getMessage('SMARTSEO_FRA_UI_ENTITY_DATE_CHANGE'),
                'sort' => 'DATE_CHANGE',
                'default' => false,
            ],
            [
                'id' => 'CREATED_BY',
                'title' => Loc::getMessage('SMARTSEO_FRA_UI_ENTITY_CREATED_BY'),
                'content' => Loc::getMessage('SMARTSEO_FRA_UI_ENTITY_CREATED_BY'),
                'sort' => 'CREATED_BY',
                'default' => false,
            ],
            [
                'id' => 'MODIFIED_BY',
                'title' => Loc::getMessage('SMARTSEO_FRA_UI_ENTITY_MODIFIED_BY'),
                'content' => Loc::getMessage('SMARTSEO_FRA_UI_ENTITY_MODIFIED_BY'),
                'sort' => 'MODIFIED_BY',
                'default' => false,
            ],
            [
                'id' => 'SORT',
                'title' => Loc::getMessage('SMARTSEO_FRA_UI_ENTITY_SORT'),
                'content' => Loc::getMessage('SMARTSEO_FRA_UI_ENTITY_SORT'),
                'sort' => 'SORT',
                'default' => false,
            ],
        ];
    }

    private function getIblockTypeItems($iblockTypes = [])
    {
        $rows = $this->getIblockTypeLanguageList([
          ], [
            'IBLOCK_TYPE_ID' => $iblockTypes
          ], [
            'IBLOCK_TYPE_ID',
            'NAME'
          ], [
            'IBLOCK_TYPE_ID',
            'NAME'
          ]
        );

        $result = [];
        foreach ($rows as $row) {
            $result[$row['IBLOCK_TYPE_ID']] = "$row[NAME]";
        }

        return $result;
    }

    private function getIblockItems($iblockIds)
    {
        $rows = $this->getIblockList(
          [], ['ID' => $iblockIds], ['ID', 'NAME']
        );

        $result = [];
        foreach ($rows as $row) {
            $result[$row['ID']] = "[$row[ID]] $row[NAME]";
        }

        return $result;
    }

    private function getIblockSectionItems($iblockIds)
    {
        if (!$iblockIds) {
            return [];
        }

        $rows = SmartseoFilterIblockSectionsTable::getList([
              'select' => [
                  'SECTION_ID',
                  'IBLOCK_ID' => 'FILTER_RULE.IBLOCK_ID',
                  'SECTION_NAME' => 'SECTION.NAME',
                  'DEPTH_LEVEL' => 'SECTION.DEPTH_LEVEL',
                  'LEFT_MARGIN' => 'SECTION.LEFT_MARGIN',
              ],
              'group' => [
                  'SECTION_ID'
              ],
              'filter' => [
                  'IBLOCK_ID' => $iblockIds
              ],
              'order' => [
                  'LEFT_MARGIN' => 'ASC',
                  'DEPTH_LEVEL' => 'ASC',
                  'SECTION_NAME' => 'ASC'
              ],
              'cache' => [
                  'ttl' => SmartseoFilterIblockSectionsTable::getCacheTtl(),
              ],
          ])->fetchAll();

        $result = [];

        foreach ($rows as $row) {
            if (!$result[$row['IBLOCK_ID']]) {
                $result[$row['IBLOCK_ID']][''] = Loc::getMessage('SMARTSEO_FRA_UI_VALUE_ANY');
            }
            $result[$row['IBLOCK_ID']][$row['SECTION_ID']] = str_repeat(' . ', $row['DEPTH_LEVEL']) . "[$row[SECTION_ID]] $row[SECTION_NAME]";
        }

        return $result;
    }

    private function getSiteItems($siteIds)
    {
        $rows = $this->getSiteList(
          [], [
              'LID' => $siteIds
          ], [
              'LID', 'NAME'
          ]
        );

        $result = [];
        foreach ($rows as $row) {
            $result[$row['LID']] = "[$row[LID]] $row[NAME]";
        }

        return $result;
    }

}
