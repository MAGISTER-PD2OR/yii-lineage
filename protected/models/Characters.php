<?php

/**
 * This is the model class for table "characters".
 *
 * The followings are the available columns in table 'characters':
 * @property string $account_name
 * @property integer $obj_Id
 * @property string $char_name
 * @property integer $face
 * @property integer $hairStyle
 * @property integer $hairColor
 * @property integer $sex
 * @property integer $heading
 * @property integer $x
 * @property integer $y
 * @property integer $z
 * @property integer $karma
 * @property integer $pvpkills
 * @property integer $pkkills
 * @property integer $clanid
 * @property string $createtime
 * @property string $deletetime
 * @property string $title
 * @property integer $rec_have
 * @property integer $rec_left
 * @property integer $rec_bonus_time
 * @property integer $hunt_points
 * @property integer $hunt_time
 * @property integer $accesslevel
 * @property integer $online
 * @property string $onlinetime
 * @property string $lastAccess
 * @property string $leaveclan
 * @property string $deleteclan
 * @property integer $nochannel
 * @property integer $pledge_type
 * @property integer $pledge_rank
 * @property integer $lvl_joined_academy
 * @property string $apprentice
 * @property string $key_bindings
 * @property integer $pcBangPoints
 * @property integer $vitality
 * @property integer $fame
 * @property integer $bookmarks
 * @property integer $bot_report_points
 * @property string $lastVoteHopzone
 * @property string $lastVoteTopzone
 * @property string $hasVotedHop
 * @property string $hasVotedTop
 * @property string $monthVotes
 * @property string $totalVotes
 * @property string $tries
 */
class Characters extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return Characters the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}

	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'characters';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('obj_Id, face, hairStyle, hairColor, sex, heading, x, y, z, karma, pvpkills, pkkills, clanid, rec_have, rec_left, rec_bonus_time, hunt_points, hunt_time, accesslevel, online, nochannel, pledge_type, pledge_rank, lvl_joined_academy, pcBangPoints, vitality, fame, bookmarks, bot_report_points', 'numerical', 'integerOnly'=>true),
			array('account_name', 'length', 'max'=>45),
			array('char_name', 'length', 'max'=>35),
			array('createtime, deletetime, onlinetime, lastAccess, leaveclan, deleteclan, apprentice, hasVotedHop, hasVotedTop, monthVotes, totalVotes, tries', 'length', 'max'=>10),
			array('title', 'length', 'max'=>16),
			array('key_bindings', 'length', 'max'=>8192),
			array('lastVoteHopzone, lastVoteTopzone', 'length', 'max'=>20),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('account_name, obj_Id, char_name, face, hairStyle, hairColor, sex, heading, x, y, z, karma, pvpkills, pkkills, clanid, createtime, deletetime, title, rec_have, rec_left, rec_bonus_time, hunt_points, hunt_time, accesslevel, online, onlinetime, lastAccess, leaveclan, deleteclan, nochannel, pledge_type, pledge_rank, lvl_joined_academy, apprentice, key_bindings, pcBangPoints, vitality, fame, bookmarks, bot_report_points, lastVoteHopzone, lastVoteTopzone, hasVotedHop, hasVotedTop, monthVotes, totalVotes, tries', 'safe', 'on'=>'search'),
		);
	}

	/**
	 * @return array relational rules.
	 */
	public function relations()
	{
		// NOTE: you may need to adjust the relation name and the related
		// class name for the relations automatically generated below.
		return array(
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'account_name' => 'Account Name',
			'obj_Id' => 'Obj',
			'char_name' => 'Char Name',
			'face' => 'Face',
			'hairStyle' => 'Hair Style',
			'hairColor' => 'Hair Color',
			'sex' => 'Sex',
			'heading' => 'Heading',
			'x' => 'X',
			'y' => 'Y',
			'z' => 'Z',
			'karma' => 'Karma',
			'pvpkills' => 'Pvpkills',
			'pkkills' => 'Pkkills',
			'clanid' => 'Clanid',
			'createtime' => 'Createtime',
			'deletetime' => 'Deletetime',
			'title' => 'Title',
			'rec_have' => 'Rec Have',
			'rec_left' => 'Rec Left',
			'rec_bonus_time' => 'Rec Bonus Time',
			'hunt_points' => 'Hunt Points',
			'hunt_time' => 'Hunt Time',
			'accesslevel' => 'Accesslevel',
			'online' => 'Online',
			'onlinetime' => 'Onlinetime',
			'lastAccess' => 'Last Access',
			'leaveclan' => 'Leaveclan',
			'deleteclan' => 'Deleteclan',
			'nochannel' => 'Nochannel',
			'pledge_type' => 'Pledge Type',
			'pledge_rank' => 'Pledge Rank',
			'lvl_joined_academy' => 'Lvl Joined Academy',
			'apprentice' => 'Apprentice',
			'key_bindings' => 'Key Bindings',
			'pcBangPoints' => 'Pc Bang Points',
			'vitality' => 'Vitality',
			'fame' => 'Fame',
			'bookmarks' => 'Bookmarks',
			'bot_report_points' => 'Bot Report Points',
			'lastVoteHopzone' => 'Last Vote Hopzone',
			'lastVoteTopzone' => 'Last Vote Topzone',
			'hasVotedHop' => 'Has Voted Hop',
			'hasVotedTop' => 'Has Voted Top',
			'monthVotes' => 'Month Votes',
			'totalVotes' => 'Total Votes',
			'tries' => 'Tries',
		);
	}

	/**
	 * Retrieves a list of models based on the current search/filter conditions.
	 * @return CActiveDataProvider the data provider that can return the models based on the search/filter conditions.
	 */
	public function search()
	{
		// Warning: Please modify the following code to remove attributes that
		// should not be searched.

		$criteria=new CDbCriteria;

		$criteria->compare('account_name',$this->account_name,true);
		$criteria->compare('obj_Id',$this->obj_Id);
		$criteria->compare('char_name',$this->char_name,true);
		$criteria->compare('face',$this->face);
		$criteria->compare('hairStyle',$this->hairStyle);
		$criteria->compare('hairColor',$this->hairColor);
		$criteria->compare('sex',$this->sex);
		$criteria->compare('heading',$this->heading);
		$criteria->compare('x',$this->x);
		$criteria->compare('y',$this->y);
		$criteria->compare('z',$this->z);
		$criteria->compare('karma',$this->karma);
		$criteria->compare('pvpkills',$this->pvpkills);
		$criteria->compare('pkkills',$this->pkkills);
		$criteria->compare('clanid',$this->clanid);
		$criteria->compare('createtime',$this->createtime,true);
		$criteria->compare('deletetime',$this->deletetime,true);
		$criteria->compare('title',$this->title,true);
		$criteria->compare('rec_have',$this->rec_have);
		$criteria->compare('rec_left',$this->rec_left);
		$criteria->compare('rec_bonus_time',$this->rec_bonus_time);
		$criteria->compare('hunt_points',$this->hunt_points);
		$criteria->compare('hunt_time',$this->hunt_time);
		$criteria->compare('accesslevel',$this->accesslevel);
		$criteria->compare('online',$this->online);
		$criteria->compare('onlinetime',$this->onlinetime,true);
		$criteria->compare('lastAccess',$this->lastAccess,true);
		$criteria->compare('leaveclan',$this->leaveclan,true);
		$criteria->compare('deleteclan',$this->deleteclan,true);
		$criteria->compare('nochannel',$this->nochannel);
		$criteria->compare('pledge_type',$this->pledge_type);
		$criteria->compare('pledge_rank',$this->pledge_rank);
		$criteria->compare('lvl_joined_academy',$this->lvl_joined_academy);
		$criteria->compare('apprentice',$this->apprentice,true);
		$criteria->compare('key_bindings',$this->key_bindings,true);
		$criteria->compare('pcBangPoints',$this->pcBangPoints);
		$criteria->compare('vitality',$this->vitality);
		$criteria->compare('fame',$this->fame);
		$criteria->compare('bookmarks',$this->bookmarks);
		$criteria->compare('bot_report_points',$this->bot_report_points);
		$criteria->compare('lastVoteHopzone',$this->lastVoteHopzone,true);
		$criteria->compare('lastVoteTopzone',$this->lastVoteTopzone,true);
		$criteria->compare('hasVotedHop',$this->hasVotedHop,true);
		$criteria->compare('hasVotedTop',$this->hasVotedTop,true);
		$criteria->compare('monthVotes',$this->monthVotes,true);
		$criteria->compare('totalVotes',$this->totalVotes,true);
		$criteria->compare('tries',$this->tries,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}