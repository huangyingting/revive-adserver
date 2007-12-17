<?php
/*
+---------------------------------------------------------------------------+
| Openads v${RELEASE_MAJOR_MINOR}                                                              |
| ============                                                              |
|                                                                           |
| Copyright (c) 2003-2007 Openads Limited                                   |
| For contact details, see: http://www.openads.org/                         |
|                                                                           |
| This program is free software; you can redistribute it and/or modify      |
| it under the terms of the GNU General Public License as published by      |
| the Free Software Foundation; either version 2 of the License, or         |
| (at your option) any later version.                                       |
|                                                                           |
| This program is distributed in the hope that it will be useful,           |
| but WITHOUT ANY WARRANTY; without even the implied warranty of            |
| MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the             |
| GNU General Public License for more details.                              |
|                                                                           |
| You should have received a copy of the GNU General Public License         |
| along with this program; if not, write to the Free Software               |
| Foundation, Inc., 59 Temple Place, Suite 330, Boston, MA  02111-1307  USA |
+---------------------------------------------------------------------------+
$Id $
*/

require_once MAX_PATH . '/lib/OA/Dal.php';
require_once MAX_PATH . '/lib/OA/Dll.php';
require_once MAX_PATH . '/lib/max/Dal/tests/util/DalUnitTestCase.php';

/**
 *
 * @abstract A base class for generating Openads test data using DataObjects
 * @package Test Classes
 * @author Monique Szpak <monique.szpak@openads.org>
 * @todo more _insert methods
 *
 */
class OA_Test_Data
{

    var $oDbh;
    var $oNow;

    var $doAgency;
    var $doClients;
    var $doAffiliates;
    var $doCampaigns;
    var $doBanners;
    var $doZones;
    var $doAdZoneAssoc;

    var $doAcls;
    var $doAclsChannel;
    var $doCampaignsTrackers;
    var $doChannel;
    var $doTrackers;
    var $doPreference;
    var $doVariables;


    var $aIds = array(
                        'agency'=>array(),
                        'clients'=>array(),
                        'affiliates'=>array(),
                        'campaigns'=>array(),
                        'banners'=>array(),
                        'zones'=>array(),
                        'ad_zone_assoc'=>array(),
                        'acls'=>array(),
                        'acls_channel'=>array(),
                        'campaigns_trackers'=>array(),
                        'channel'=>array(),
                        'trackers'=>array(),
                        'variables'=>array(),
                        'preference'=>array(),
                      );


    /**
     * The constructor method.
     */
    function OA_Test_Data()
    {
        $this->init();
    }

    function init()
    {
        $this->oDbh =& OA_DB::singleton();

        $this->oNow = new Date();

        $this->doAgency             = OA_Dal::factoryDO('agency');
        $this->doClients            = OA_Dal::factoryDO('clients');
        $this->doAffiliates         = OA_Dal::factoryDO('affiliates');
        $this->doCampaigns          = OA_Dal::factoryDO('campaigns');
        $this->doBanners            = OA_Dal::factoryDO('banners');
        $this->doZones              = OA_Dal::factoryDO('zones');
        $this->doAdZoneAssoc        = OA_Dal::factoryDO('ad_zone_assoc');

        $this->doAcls               = OA_Dal::factoryDO('acls');
        $this->doAclsChannel        = OA_Dal::factoryDO('acls_channel');
        $this->doCampaignsTrackers  = OA_Dal::factoryDO('campaigns_trackers');
        $this->doChannel            = OA_Dal::factoryDO('channel');
        $this->doTrackers           = OA_Dal::factoryDO('trackers');
        $this->doPreference         = OA_Dal::factoryDO('preference');
        $this->doVariables          = OA_Dal::factoryDO('variables');

    }

    function _insertAgency($aData)
    {
        $this->doAgency->name = 'Test Agency';
        $this->doAgency->contact = 'Test Contact';
        $this->doAgency->email = 'agency@example.com';
        $this->doAgency->permissions = 0;
        $this->doAgency->agencyid = '';
        $this->doAgency->updated = $this->oNow->format('%Y-%m-%d %H:%M:%S');
        $this->doAgency->setFrom($aData);
        return DataGenerator::generateOne($this->doAgency);
    }

    function _insertClients($aData)
    {
        $this->doClients->agencyid=0;
        $this->doClients->clientname='Test Advertiser';
        $this->doClients->contact='Test Contact';
        $this->doClients->email='test1@example.com';
        $this->doClients->report='t';
        $this->doClients->reportinterval=7;
        $this->doClients->reportlastdate='2004-11-26';
        $this->doClients->reportdeactivate='t';
        $this->doClients->clientid='';
        $this->doClients->updated = $this->oNow->format('%Y-%m-%d %H:%M:%S');
        $this->doClients->setFrom($aData);
        return DataGenerator::generateOne($this->doClients);
    }

    function _insertAffiliates($aData)
    {
        $this->doAffiliates->name = 'Test Publisher';
        $this->doAffiliates->mnemonic = 'ABC';
        $this->doAffiliates->contact = 'Affiliate Contact';
        $this->doAffiliates->email = 'affiliate@example.com';
        $this->doAffiliates->website = 'www.example.com';
        $this->doAffiliates->updated = $this->oNow->format('%Y-%m-%d %H:%M:%S');
        $this->doAffiliates->setFrom($aData);
        return DataGenerator::generateOne($this->doAffiliates);
    }

    function _insertCampaigns($aData)
    {
        $this->doCampaigns->campaignname = 'Test Advertiser - Default Campaign';
        $this->doCampaigns->views = -1;
        $this->doCampaigns->clicks = -1;
        $this->doCampaigns->conversions = -1;
        $this->doCampaigns->expire = OA_Dal::noDateValue();
        $this->doCampaigns->activate = OA_Dal::noDateValue();
        $this->doCampaigns->status = OA_ENTITY_STATUS_RUNNING;
        $this->doCampaigns->priority = 'l';
        $this->doCampaigns->weight = 1;
        $this->doCampaigns->target_impression = 1;
        $this->doCampaigns->target_click = 0;
        $this->doCampaigns->target_conversion = 0;
        $this->doCampaigns->anonymous = 'f';
        $this->doCampaigns->companion = 0;
        $this->doCampaigns->updated = $this->oNow->format('%Y-%m-%d %H:%M:%S');
        $this->doCampaigns->setFrom($aData);
        return DataGenerator::generateOne($this->doCampaigns);
    }

    function _insertBanners($aData)
    {
        $this->doBanners->status=OA_ENTITY_STATUS_RUNNING;
        $this->doBanners->contenttype='';
        $this->doBanners->pluginversion=0;
        $this->doBanners->storagetype='html';
        $this->doBanners->filename='';
        $this->doBanners->imageurl='';
        $this->doBanners->htmltemplate='<h3>Test Banner</h3>';
        $this->doBanners->htmlcache='<h3>Test Banner</h3>';
        $this->doBanners->width=0;
        $this->doBanners->height=0;
        $this->doBanners->weight=1;
        $this->doBanners->seq=0;
        $this->doBanners->target='';
        $this->doBanners->url='http://example.com/';
        $this->doBanners->alt='';
        $this->doBanners->statustext='';
        $this->doBanners->bannertext='';
        $this->doBanners->description='Banner';
        $this->doBanners->autohtml='t';
        $this->doBanners->adserver='';
        $this->doBanners->block=0;
        $this->doBanners->capping=0;
        $this->doBanners->session_capping=0;
        $this->doBanners->compiledlimitation='';
        $this->doBanners->append='';
        $this->doBanners->appendtype=0;
        $this->doBanners->bannertype=0;
        $this->doBanners->alt_filename='';
        $this->doBanners->alt_imageurl='';
        $this->doBanners->alt_contenttype='';
        $this->doBanners->bannerid='t';
        $this->doBanners->updated = $this->oNow->format('%Y-%m-%d %H:%M:%S');
        $this->doBanners->setFrom($aData);
        if (empty($this->doBanners->acls_updated)) {
            $this->doBanners->acls_updated = $this->oNow->format('%Y-%m-%d %H:%M:%S');
        }
        return DataGenerator::generateOne($this->doBanners);
    }

    function _insertZones($aData)
    {
        $this->doZones->description='';
        $this->doZones->delivery=0;
        $this->doZones->zonetype=3;
        $this->doZones->category='';
        $this->doZones->width=-1;
        $this->doZones->height=-1;
        $this->doZones->ad_selection='';
        $this->doZones->chain='';
        $this->doZones->prepend='';
        $this->doZones->append='';
        $this->doZones->appendtype=0;
        $this->doZones->inventory_forecast_type=0;
        $this->doZones->what='';
        $this->doZones->updated = $this->oNow->format('%Y-%m-%d %H:%M:%S');
        $this->doZones->setFrom($aData);
        return DataGenerator::generateOne($this->doZones);
    }

    function _insertAdZoneAssoc($aData)
    {
        $this->doAdZoneAssoc->priority = 0;
        $this->doAdZoneAssoc->link_type = 1;
        $this->doAdZoneAssoc->priority_factor = 1;
        $this->doAdZoneAssoc->to_be_delivered = 1;
        $this->doAdZoneAssoc->setFrom($aData);
        return DataGenerator::generateOne($this->doAdZoneAssoc);
    }

    function _insertCampaignsTracker($aData)
    {
        $this->doCampaignsTrackers->setFrom($aData);
        return DataGenerator::generateOne($this->doCampaignsTrackers);
    }

    function _insertAcls($aData)
    {
        $this->doAcls->setFrom($aData);
        return DataGenerator::generateOne($this->doAcls);
    }

    function _insertChannel($aData)
    {
        $this->doChannel->acls_updated = $this->oNow->format('%Y-%m-%d %H:%M:%S');
        $this->doChannel->setFrom($aData);
        return DataGenerator::generateOne($this->doChannel);
    }

    function _insertAclsChannel($aData)
    {
        $this->doAclsChannel->setFrom($aData);
        return DataGenerator::generateOne($this->doAclsChannel);
    }

    function _insertTrackers($aData)
    {
        $this->doTrackers->setFrom($aData);
        return DataGenerator::generateOne($this->doTrackers);
    }

    function _insertVariables($aData)
    {
        $this->doVariables->setFrom($aData);
        return DataGenerator::generateOne($this->doVariables);
    }

    function _insertPreference($aData)
    {
        $this->doPreference->setFrom($aData);
        return DataGenerator::generateOne($this->doPreference);
    }

    function _insertDefaultPreference()
    {
        $aData['agencyid'] = 0;
        return $this->_insertPreference($aData);
    }

    /**
     * demonstration / default
     *
     * A method to generate data for testing.
     * can be overriden by child clases
     *
     * insertion order is important
     *
     * agency
     * client
     * affiliate
     * campaign
     * banner
     * zone
     * ad_zone_assoc
     *
     * @access private
     */
    function generateTestData()
    {
        // Add an agency record
        $aAgency['name'] = 'Test Agency';
        $aAgency['contact'] = 'Test Contact';
        $aAgency['email'] = 'agency@example.com';
        $this->aIds['agency'][1] = $this->_insertAgency($aAgency);

        // Add a client record (advertiser)
        $aClient['agencyid'] = $this->aIds['agency'][1];
        $aClient['clientname'] = 'Test Client';
        $aClient['email'] = 'client@example.com';
        $this->aIds['clients'][1] = $this->_insertClients($aClient);

        // Add an affiliate (publisher) record
        $aAffiliate['agencyid'] = $this->aIds['agency'][1];
        $aAffiliate['name'] = 'Test Publisher';
        $aAffiliate['mnemonic'] = 'ABC';
        $aAffiliate['contact'] = 'Affiliate Contact';
        $aAffiliate['email'] = 'affiliate@example.com';
        $aAffiliate['website'] = 'www.example.com';
        $this->aIds['affiliates'][1] = $this->_insertAffiliate($aAffiliate);

        // Populate campaigns table
        $aCampaign['campaignname'] = 'Test Campaign';
        $aCampaign['clientid'] = $this->aIds['clients'][1];
        $aCampaign['views'] = 500;
        $aCampaign['clicks'] = 0;
        $aCampaign['conversions'] = 401;
        $this->aIds['campaigns'][1] = $this->_insertCampaign($aCampaign);

        // Add a banner
        $aBanners['campaignid'] = $this->aIds['campaigns'][1];
        $aBanners['contenttype'] = 'txt';
        $aBanners['storagetype'] = 'txt';
        $aBanners['url'] = 'http://www.example.com';
        $aBanners['alt'] = 'Test Campaign - Text Banner';
        $aBanners['compiledlimitation'] = 'phpAds_aclCheckDate(\'20050502\', \'!=\') and phpAds_aclCheckClientIP(\'2.22.22.2\', \'!=\') and phpAds_aclCheckLanguage(\'(sq)|(eu)|(fo)|(fi)\', \'!=\')';
        $this->aIds['banners'][1] = $this->_insertBanner($aBanners);

        // Add zone record
        $aZone['affiliateid'] = $this->aIds['affiliates'][1];
        $aZone['zonename'] = 'Default Zone';
        $aZone['description'] = '';
        $aZone['delivery'] = 0;
        $aZone['zonetype'] =3;
        $aZone['category'] = '';
        $aZone['width'] = 728;
        $aZone['height'] = 90;
        $this->aIds['zones'][1] = $this->_insertZone($aZone);

        // Add ad_zone_assoc record
        $aAdZone['ad_id'] = $this->aIds['banners'][1];
        $aAdZone['zone_id'] = $this->aIds['zones'][1];
        $this->aIds['ad_zone_assoc'][1] = $this->_insertAdZoneAssoc($aAdZone);
    }
}

?>
