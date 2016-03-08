<?php

namespace Oml\PHPFileManager\Document\CPA005\Utility;

class TransactionType
{
	/**
	 * Pre Authorized Transactions
	 *
	 * @var integer 
	 */
	const PAYROLL_DEPOSIT 		   = 200;
	const SPECIAL_PAYROLL 		   = 201;
	const VACATION_PAYROLL 		   = 202;
	const OVERTIME_PAYROLL 		   = 203;
	const ADVANCE_PAYROLL 		   = 204;
	const COMMISSION_PAYROLL 	   = 205;
	const BONUS_PAYROLL 		   = 206;
	const ADJUSTMENT_PAYROLL 	   = 207;
	const PENSION 				   = 230;
	const FEDERAL_PENSION 		   = 231;
	const PROVISION_PENSION 	   = 232;
	const PRIVATE_PENSION 		   = 233;
	const ANNUITY 				   = 240;
	const DIVIDEND 				   = 250;
	const COMMON_DIVIDEND 		   = 251;
	const PREFERRED_DIVIDEND 	   = 252;
	const INVESTMENT 			   = 260;
	const MUTUAL_FUNDS 			   = 261;
	const SPOUSAL_RSP_CONTRIBUTION = 265;
	const RESP_CONTRIBUTION 	   = 263;
	const RSP_CONTRIBUTION 		   = 271;
	const RETIREMENT_INCOME_FUND   = 272;
	const TAX_FREE_SAVINGS_ACCOUNT = 273;
	const RDSP_CONTRIBUTION 	   = 274;
	const INTEREST 				   = 280;
	const LOTTERY_PRIZE_PAYMENT    = 281;

	/**
	 * For Federal Government Use Only
	 *
	 * @var integer 
	 */
	const FEDERAL_PAYMENT 	 = 300;
	const AGRI_STABILIZATION = 301;
	const AGRI_INVEST 		 = 302;
	const HRDC_TRAINING 	 = 303;
	const CHILD_TAX_CHILD 	 = 308;
	const GST 				 = 309;
	const CPP 				 = 310;
	const OLD_AGE_SECURITY 	 = 311;
	const WAR_VETERANS_ALLOW = 312;
	const VAC 				 = 313;
	const PS_SUPERANNUATION  = 315;
	const CF_SUPERANNUATION  = 316;
	const TAX_REFUND 	     = 317;
	const EI 				 = 318;
	const PAD_CCRA 			 = 319;
	const STUDENT_LOAN 		 = 320;
	const CSB_INTEREST 		 = 321;
	const EXTERNAL_AFFAIRS   = 322;
	const SAVINGS_PLAN 		 = 323;
	const ACCESS_GRANTS 	 = 324;

	/**
	 * Pre Authorized Transactions
	 *
	 * @var integer 
	 */
	const INSURANCE 					= 330;
	const LIFE_INSURANCE 				= 331;
	const AUTO_INSURANCE 				= 332;
	const PROPERTY_INSURANCE 			= 333;
	const CASUALITY_INSURANCE 			= 334;
	const MORTGAGE_INSURANCE 			= 335;
	const HEALTH_DENTAL_CLAIM_INSURANCE = 336;
	const LOANS 						= 350;
	const PERSONAL_LOANS 				= 351;
	const DEALER_PLAN_LOANS 			= 352;
	const FARM_IMPROVEMENT_LOANS 		= 353;
	const HOME_IMPROVEMENT_LOANS 		= 354;
	const TERM_LOANS 					= 355;
	const INSURANCE_LOANS 				= 356;
	const MORTGAGE 						= 370;
	const RESIDENTIAL_MORTGAGE 			= 371;
	const COMMERCIAL_MORTGAGE 			= 372;
	const FARM_MORTGAGE 				= 373;
	const TAXES 						= 380;
	const INCOME_TAXES 					= 381;
	const SALES_TAXES 					= 382;
	const CORPORATE_TAXES 				= 383;
	const SCHOOL_TAXES 					= 384;
	const PROPERTY_TAXES 				= 385;
	const WATER_TAXES 					= 386;
	const RENT_LEASES 					= 400;
	const RESIDENTIAL_RENT_LEASES 		= 401;
	const COMMERCIAL_RENT_LEASES 		= 402;
	const EQUIPMENT_RENT_LEASES 		= 403;
	const AUTOMOBILE_RENT_LEASES 		= 404;
	const APPLIANCE_RENT_LEASES 		= 405;
	const CASH_MANAGEMENT 				= 420;
	const BILL_PAYMENT 					= 430;
	const TELEPHONE_BILL_PAYMENT 		= 431;
	const GASOLINE_BILL_PAYMENT 		= 432;
	const HYDRO_BILL_PAYMENT 			= 433;
	const CABLE_BILL_PAYMENT 			= 434;
	const FUEL_BILL_PAYMENT 			= 435;
	const UTILITY_BILL_PAYMENT 			= 436;
	const INTERNET_ACCESS_PAYMENT 		= 437;
	const WATER_BILL_PAYMENT 			= 438;
	const AUTO_PAYMENT 					= 439;
	const MISC_PAYMENTS 				= 450;
	const CUSTOMER_CHEQUES 				= 451;
	const EXPENSE_PAYMENT 				= 452;
	const ACCOUNTS_PAYABLE 				= 460;
	const FEES_DUES 					= 470;
	const DONATIONS 					= 480;

	/**
	 * For Provincial Local Government Use Only
	 *
	 * @var integer 
	 */
	const PROV_LOCAL_GOVT_PAYMENT		  = 600;
	const FAMILY_SUPPORT_PLAN			  = 601;
	const HOUSING_ALLOWANCE				  = 602;
	const INCOME_SECURITY_BENEFITS		  = 603;
	const FAMILY_BEN 					  = 604;
	const PROV_TERR 					  = 605;
	const WORKERS_COMPENSATION_BOARD 	  = 606;
	const EMPLOYMENT_ASSISTANCE_ALLOWANCE = 607;
	const AUTOMOBILE_INSURANCE_PLAN		  = 608;
	const HEALTH_CARE_PREMIUM			  = 609;
	const OFFENCES_AND_FINES			  = 610;
	const DISABILITY_PAYMENT			  = 611;
	const PARENTAL_INSURANCE			  = 612;
	const STUDENT_LOAN					  = 613;
	const GRANT_BURSARY					  = 614;
	const SOLIDARITY_TAX_CREDIT			  = 615;
	const CHILDREN_ASSISTANCE			  = 616;
	const TAX_REFUND					  = 617;

	/**
	 * Future Use 
	 *
	 * @var integer 
	 */
	const INTER_FI_FUNDS_TRANSFER_DEBIT = 650;
	const BUSINESS_PAD				    = 700;

	/**
	 * Commercial Pre Authorized debits (PADs)
	 *
	 * @var integer 
	 */
	const COMMERCIAL_INVESTMENTS 			= 701;
	const COMMERCIAL_INSURANCE 				= 702;
	const COMMERCIAL_AUTO_INSURANCE 		= 703;
	const COMMERCIAL_PROPERTY_INSURANCE 	= 704;
	const COMMERCIAL_CASUALITY_INSURANCE 	= 705;
	const COMMERCIAL_MORTGAGE_INSURANCE 	= 706;
	const COMMERCIAL_LOANS 					= 707;
	const COMMERCIAL_MORTGAGE 				= 708;
	const COMMERCIAL_TAXES 					= 709;
	const COMMERCIAL_INCOME_TAXES 			= 710;
	const COMMERCIAL_SALES_TAXES 			= 711;
	const COMMERCIAL_GST 					= 712;
	const COMMERCIAL_PROPERTY_TAXES 		= 713;
	const COMMERCIAL_RENT_LEASE 			= 714;
	const COMMERCIAL_EQUIPMENT_RENT_LEASE 	= 715;
	const COMMERCIAL_AUTOMOBILE_RENT_LEASE 	= 716;
	const COMMERCIAL_CASH_MANAGEMENT 		= 717;
	const COMMERCIAL_BILL_PAYMENT 			= 718;
	const COMMERCIAL_TELEPHONE_BILL_PAYMENT = 719;
	const COMMERCIAL_GASOLINE_BILL_PAYMENT 	= 720;
	const COMMERCIAL_HYDRO_BILL_PAYMENT 	= 721;
	const COMMERCIAL_CABLE_BILL_PAYMENT 	= 722;
	const COMMERCIAL_FUEL_BILL_PAYMENT 		= 723;
	const COMMERCIAL_UTILITY_BILL_PAYMENT 	= 724;
	const COMMERCIAL_INTERNET_BILL_PAYMENT 	= 725;
	const COMMERCIAL_WATER_BILL_PAYMENT 	= 726;
	const COMMERCIAL_AUTO_PAYMENT 			= 727;
	const COMMERCIAL_EXPENSE_PAYMENT 		= 728;
	const COMMERCIAL_ACCOUNTS_PAYABLE 		= 729;
	const COMMERCIAL_FEES_DUES 				= 730;
	const COMMERCIAL_CREDITOR_INSURANCE 	= 731;

	/**
	 * Returned/Dishonoured Items
	 *
	 * @var integer 
	 */
	const EDIT_REJECT 								= 900;
	const NSF_DEBIT 								= 901;
	const ACCOUNT_NOT_FOUND 						= 902;
	const PAYMENT_STOPPED_RECALLED 					= 903;
	const ACCOUNT_CLOSED 							= 905;
	const NO_DEBIT_ALLOWED 							= 907;
	const FUNDS_NOT_CLEARED_DEBIT_ONLY 				= 908;
	const CURRENCY_ACCOUNT_MISMATCH 				= 909;
	const PAYOR_PAYEE_DECEASED 						= 910;
	const ACCOUNT_FROZEN 							= 911;
	const INVALID_INCORRECT_ACCOUNT_NO 				= 912;
	const INCORRECT_PAYOR_PAYEE_NAME 				= 914;
	const NO_AGREEMENT_EXISTED 						= 915;
	const NOT_ACCORDING_TO_AGREEMENT_PERSONAL 		= 916;
	const AGREEMENT_REVOKED_PERSONAL 				= 917;
	const NO_CONFIRMATION_PRE_NOTIFICATION_PERSONAL = 918;
	const NOT_ACCORDING_TO_AGREEMENT_BUSINESS 		= 919;
	const AGREEMENT_REVOKED_BUSINESS 				= 920;
	const NO_CONFIRMATION_PRE_NOTIFICATION_BUSINESS = 921;

	/**
	 * Credit only
	 *
	 * @var integer 
	 */
	const CUSTOMER_INITIATED_RETURN = 922;

	/**
	 * Default
	 *
	 * @var integer 
	 */
	const INSTITUTION_IN_DEFAULT = 990;
}
