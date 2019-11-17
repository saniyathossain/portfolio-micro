<?php

namespace App\Http\Modules\Frontend\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Modules\Frontend\Library\FrontendLibraryTrait;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;
use Illuminate\View\View;
use Illuminate\Support\Facades\Cache;

/**
 * FrontendController
 */
class FrontendController extends Controller
{
    use FrontendLibraryTrait;

	/**
	 * getHome
	 *
	 * @return \Illuminate\View\View
	 */
	public function getHome(): View
	{
		$view								= $this->moduleFrontendViewPagesHome;
        $data['me']							= $this->getMyInfo();
		$data['technical_skills']			= $this->getTechnicalSkills();
		$data['education_data']				= $this->getEducation();
		$data['professional_experiences']	= $this->getProfessionalExperiences();
		$data['title']						= $data['me']->fullname;

		return view($view, $data);
	}

    /**
     * getTechnicalSkills
     *
     * @param  int $userId
     * @param bool $cacheReset
     *
     * @return \Illuminate\Support\Collection
     */
	protected function getTechnicalSkills(int $userId = 1, bool $cacheReset = false): Collection
	{
        (string) $cacheKey  = 'techinal-skills';
        (int) $cacheExpiryTime = 600;

        if ($cacheReset):
            Cache::forget($cacheKey);
        endif;

        return Cache::remember($cacheKey, $cacheExpiryTime, function() use($userId) {
            return DB::table('p_technical_skills')
                        ->where('p_technical_skills.user_id', $userId)
                        ->where('p_technical_skills.status', 1)
                        ->get();
        });
	}

    /**
     * getMyInfo
     *
     * @param  int $userId
     * @param bool $cacheReset
     *
     * @return object
     */
	protected function getMyInfo(int $userId = 1, bool $cacheReset = false)
	{
        (string) $cacheKey = 'my-info';
        (int) $cacheExpiryTime = 600;

        if ($cacheReset) :
            Cache::forget($cacheKey);
        endif;

        return Cache::remember($cacheKey, $cacheExpiryTime, function() use($userId) {
            return DB::table('p_users')
                        ->select(['*'])
                        ->find($userId);
        });
	}

    /**
     * getEducation
     *
     * @param  int $userId
     * @param bool $cacheReset
     *
     * @return \Illuminate\Support\Collection
     */
	protected function getEducation(int $userId = 1, bool $cacheReset = false): Collection
	{
        (string) $cacheKey = 'education';
        (int) $cacheExpiryTime = 600;

        if ($cacheReset):
            Cache::forget($cacheKey);
        endif;

        return Cache::remember($cacheKey, $cacheExpiryTime, function() use($userId) {
            return DB::table('p_education')
                        ->select([
                                    'p_education.*',
                                    DB::raw('timestampdiff(year, p_education.start_date, p_education.end_date) as duration'),
                                    'p_institutes.institute_name',
                                    'p_institutes.institute_location',
                                    'p_institutes.institute_link'
                                ])
                        ->leftJoin('p_institutes', 'p_institutes.id', '=', 'p_education.institute_id')
                        ->where('p_education.user_id', $userId)
                        ->where('p_education.status', 1)
                        ->orderBy('p_education.id', 'desc')
                        ->get();
        });
	}

    /**
     * getProfessionalExperiences
     *
     * @param  int $userId
     * @param bool $cacheReset
     *
     * @return \Illuminate\Support\Collection
     */
	protected function getProfessionalExperiences(int $userId = 1, bool $cacheReset = false): Collection
	{
        (string) $cacheKey = 'professional-experience';
        (int) $cacheExpiryTime = 600;

        if ($cacheReset) :
            Cache::forget($cacheKey);
        endif;

        return Cache::remember($cacheKey, $cacheExpiryTime, function() use($userId) {
            return DB::table('p_professional_experience')
                        ->select([
                                    'p_professional_experience.*',
                                    DB::raw('timestampdiff(year, p_professional_experience.start_date, p_professional_experience.end_date) as duration'),
                                    'p_companies.company_name',
                                    'p_companies.company_location',
                                    'p_companies.company_link'
                                ])
                        ->leftJoin('p_companies', 'p_companies.id', '=', 'p_professional_experience.company_id')
                        ->where('p_professional_experience.user_id', $userId)
                        ->where('p_professional_experience.status', 1)
                        ->get();
        });
	}
}
